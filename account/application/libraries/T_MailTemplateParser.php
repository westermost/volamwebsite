<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class T_MailTemplateParser
{
    // Line feed code
    const EOL = "\n";

    // Replacement tag
    const ENCLOSURE_START = "<%";
    const ENCLOSURE_END   = "%>";

    // Prefex of template header item
    const HEADER_PREFIX = "T-";

    // Split delimiter of header item
    const HEADER_DELIMITER = ":";

    // Comment line identifier
    const COMMENT_IDENT = "#";

    /**
     * @var array Replacement data
     */
    private $_replaceList = array();

    /**
     * @var string Email template file
     */
    private $_templateFile = "";

    /**
     * @var string Email template data
     */
    private $_templateData = "";

    /**
     * @var string Email header
     */
    private $_header = array();

    /**
     * @var string Email body
     */
    private $_body = array();

    /**
     * <pre>
     * <p>[Description]</p>
     * Set the replacement target character string
     * <p>[Guideline]</p>
     * $mail = new MailTemplateParser();
     * //Set the replacement target
     * $mail->TO = "trungpt@gmail.com";
     * $mail->ID = "13";
     * // Inside <<% TO%>, <% ID%> etc. We will give the enclosed character.
     *
     * $path = "/WWW/data/mail/MAIL01.txt";
     * $info = $mail->parse($path);
     *
     * <p>[Note]</p>
     * </pre>
     * @param string $key Replacement target key
     * @param string $value Replacement character string
     */
    public function __set($key, $value)
    {
        $target = self::ENCLOSURE_START . $key . self::ENCLOSURE_END;
        $this->_replaceList[$target] = $value;
    }

    /**
     * <pre>
     * <p>[Summary]</p>
     * Parse email template
     * <p>[Guideline]</p>
     * $mail = new P_MailTemplateParser();
     * $mail->TO = "trungpt@gmail.com";
     * $mail->ID = "13";
     * // Inside <<% TO%>, <% ID%> etc. We will give the enclosed character.
     *
     * $path = "/WWW/data/mail/MAIL01.txt";
     * $info = $mail->parse($path);
     *
     * $info = $mail->parse($path);
     *
     * </pre>
     *
     * @param string $template Mail template file (full path)
     *
     * @param boolean $userHeader Using header in mail template
     *                  (true) Using the header
     *                  (false) Not using the header
     *
     * @return array
     */
    public function parse($template, $useHeader = false)
    {
        $this->_templateFile = $template;

        $this->_invokeParse($useHeader);

        if ($useHeader == false)
        {
            return $this->_body;
        }

        return array('header' => $this->_header, 'body' => $this->_body);

    }

    /**
     * Parsing email template
     *
     * @return void
     * @throws Exception
     */
    private function _invokeParse($useHeader)
    {
        // Reading template file
        $this->_readTemplateFile();

        // Repalcement template data
        $this->_replaceTemplateData();

        // Explode template data
        $this->_explodeTemplateData($useHeader);
    }

    /**
     * Reading template file
     *
     * @return void
     * @throws Exception
     */
    private function _readTemplateFile()
    {
        // Unable to read or file size is 0
        if (!is_readable($this->_templateFile)
                || filesize($this->_templateFile) <= 0) {

            $message = "EMAIL PARSE ERROR" . self::EOL
                     . "Failed to load template file！" . self::EOL
                     . "Template file[" . $this->_templateFile . "]" . self::EOL
                     ;
            throw new Exception($message);
        }

        // Get content of template file
        $this->_templateData = file_get_contents($this->_templateFile);

        // Unify new feed
        $this->_templateData = preg_replace("/\r\n|\n/u", self::EOL, $this->_templateData);
    }

    /**
     * Replace tag
     * @return void
     */
    private function _replaceTemplateData()
    {
        // If replacement tag is not set then return
        if (count($this->_replaceList) <= 0) {
            return;
        }

        // Replacement process
        foreach($this->_replaceList as $key => $value) {
            $key = preg_replace('/\//', '\\/', $key);
            $this->_templateData = preg_replace('/' . $key . '/u', $value, $this->_templateData);
        }
    }

    /**
     * Explode template data
     * @return void
     * @throws Exception
     */
    private function _explodeTemplateData($useHeader)
    {
        if ($useHeader == true)
        {
            /*
             * @buief
             * Explode between header and body email template
             * Delimiter: 2 line breaks
             */
            $array = preg_split("/(" . self::EOL . "){2}/u", $this->_templateData, 2);

            // Explode the header and body by line breaks
            $header = explode(self::EOL, $array[0]);
            $this->_body = $array[1];

            // Header field exist
            $this->_explodeTemplateHeaderDetail($header);
        }
        else
        {
            $this->_body = $this->_templateData;
        }


    }

    /**
     * Decomposition of header elements
     *
     * @param array $header header array
     * @return void
     */
    private function _explodeTemplateHeaderDetail(array $header)
    {
        foreach ($header as $line) {

            // If the beginning of the line is "#", it is treated as a comment
            if (substr($line, 0, 1) === self::COMMENT_IDENT) {
                continue;
            }

            // If there is no division identifier ":", go to the next line
            if (strpos($line, self::HEADER_DELIMITER) === false) {
                continue;
            }

            // The beginning of the line begins with "X-"
            if (self::HEADER_PREFIX
                    === strtoupper(substr($line, 0, strlen(self::HEADER_PREFIX)))) {
                // Retrieve contents after 「X-」
                // Example: 「X-"From:trungpt@gmail.com"」 ← Acquire the quoting part
                $line = mb_substr($line, mb_strlen(self::HEADER_PREFIX));
            }

            // Separate by ":" to get key / value
            $fields      = preg_split('/' . self::HEADER_DELIMITER . '/u', $line, 2);
            $headerKey   = trim($fields[0]);
            $headerValue = trim($fields[1]);

            $this->_header[$headerKey] = $headerValue;
        }
    }

}
