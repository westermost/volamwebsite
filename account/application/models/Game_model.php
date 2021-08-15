<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * =========== ItemGiftCode ===========
 * ID          int AI
 * ItemID      int
 * ItemName    nvarchar(300) NULL
 * ItemType    int
 * ============= GiftPack =============
 * pack_id         int AI
 * pack_name       nvarchar(300) NULL
 * created_by      int
 * created_at      datetime NULL
 * approved_by     int
 * approved_at     datetime NULL
 * total           int
 * ============ GiftPackItem ==========
 * pack_id     int
 * item_id     int
 * quantity    int
 * ============= GiftCode =============
 * Status          bit DEFAULT 0   [A]
 * actived_by      int NULL        [A]
 * actived_at      datetime NULL   [A]
 * ============= Mocthuong ==========
 * quantity    int                 [A]
 * gift_type   tinyint             [A]
 * ============= SpecialGift ==========
 * ID           int  AI            [A]
 * acct_id      int                [A]
 * ReceivedDay  datetime    NULL   [A]
 * Quantity     int                [A]
 * ====================================
 */
class Game_model extends CI_Model {
    private $_dbo = 'QGLAccount';
    private $_table = 'Mocthuong';

    public function __construct()
    {
        parent::__construct();
        $this->db->db_select($this->_dbo);
    }

    public function setTable($table)
    {
        $this->_table = $table;
    }

    public function getTable()
    {
        return $this->_table;
    }

    /**
     * Function: getAllGiftBox
     * Xử lý lấy ra tất cả các quà tặng từ Mốc thưởng
     * @param int $acct_id id của người dùng
     * @return array $data Mảng thông phần quà
     */
    public function getAllGiftBox($acct_id)
    {
        $subQuery = '(SELECT item_id, acct_id FROM GiftBox WHERE acct_id = \'' . $acct_id . '\')';
        $this->db->select('Mocthuong.ID, Name, Mocthuong.gift_id, Mocthuong.Point, T.acct_id, T.item_id, Mocthuong.quantity');
        $this->db->join($subQuery.' t', 'Mocthuong.gift_id = t.item_id', 'left');
        $data = $this->db->get($this->_table)->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data;
    }

    /**
     * Function: getTotalCash
     * Xử lý lấy ra tổng số cash người dùng đã nạp
     * @param int $acct_id id của người dùng
     * @return array $data Mảng thông phần quà
     */
    public function getTotalCash($acct_id)
    {
        $this->db->select('CountCard');
        $this->db->where('acct_id', $acct_id);
        $data = $this->db->get('Account')->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data[0];
    }

    /**
     * Function: getGiftById
     * Xử lý lấy ra phần quà đạt được từ mốc thưởng
     * @param int $giftId id của mốc thưởng
     * @return array $data Mảng thông phần quà
     */
    public function getGiftById($giftId)
    {
        $data = $this->db->get_where($this->_table, array('ID' => $giftId))->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data[0];
    }

    /**
     * Function: checkGiftBox
     * Xử lý kiểm tra user đã nhận quà chưa
     * @param int $acctId id của người nhận
     * @param int $giftId id của gift pack
     * @return boolean true/false
     */
    public function checkGiftBox($giftId, $acctId)
    {
        $this->db->select('item_id, acct_id');
        $this->db->where(array('item_id' => $giftId, 'acct_id' => $acctId));
        $data = $this->db->get('GiftBox')->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return false;
        }
        return true;
    }

    /**
     * Function: addGiftBox
     * Xử lý thêm các item nhận được vào giftbox
     * @param int $acctId id của người nhận
     * @param int $giftId id của gift pack
     * @param int $itemType type của item
     * @param int $quantity số lượng item
     * @param int $serialNo mã số
     * @return boolean true/false
     */
    public function addGiftBox($acctId, $giftId, $itemType, $quantity, $serialNo)
    {
        $this->db->db_select('QGLAccount');
        if (mb_strlen($giftId) <= 0 && mb_strlen($acctId) <= 0)
        {
            return NULL;
        }
        $data = array(
            'acct_id' => $acctId,
            'item_id' => $giftId,
            'itemtype' => isset($itemType) ? $itemType : 0,
            'quantity' => isset($quantity) ? $quantity : 1,
            'serialNo' => isset($serialNo) ? $serialNo : 0
        );
        $this->db->insert('GiftBox', $data);
        $error = $this->db->error();
        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return $error;
    }

    /**
     * Function: addGiftBoxFromGiftCode
     * Xử lý thêm các item nhận được từ giftcode vào giftbox
     * @param string $giftCode chuỗi giftcode
     * @param int $acctId id của người nhận
     * @return boolean true/false
     */
    public function addGiftBoxFromGiftCode($giftItems, $acctId)
    {
        // Start transaction
        $this->db->trans_begin();

        // Thêm tặng phẩm vào giftbox
        foreach ($giftItems as $item) {
            // Trường hợp thêm vào KNB
            if ($item['ItemID'] == '99999')
            {
                $yuanbao = $item['quantity'];
                $this->db->set('yuanbao', 'yuanbao + ' . (int) $yuanbao, false);
                $this->db->where('acct_id', $acctId);
                $this->db->update('Account');
//                echo $this->db->last_query();
            }
            else
            {
                $data = array(
                    'acct_id' => $acctId,
                    'item_id' => $item['ItemID'],
                    'itemtype' => $item['ItemType'],
                    'quantity' => $item['quantity'],
                    'serialNo' => 0
                );
                $this->db->insert('GiftBox', $data);
            }
        }
        // End transaction
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * Function: updateGiftCodeStatus
     * Xử lý cập nhật tình trang gift code
     * @param string $giftCode chuỗi giftcode
     * @param int $acctId id của người nhận
     */
    public function updateGiftCodeStatus($giftCode, $acctId)
    {
        if (mb_strlen($giftCode) <= 0)
        {
            return NULL;
        }

        $data = array(
            'Status' => 0,
            'actived_by' => $acctId,
            'actived_at' => date('Y-m-d H:i:s')
        );
        $this->db->where('GiftCode', $giftCode);
        $this->db->update('GiftCode', $data);
    }

    /**
     * Function: getGiftPackInfo
     * Xử lý lấy thông tin gift pack với gift code truyền vào
     * @param string $giftCode chuỗi giftcode
     * @param string $status lấy ra các giftpack chưa nhận
     * @return array $data mảng thông tin gift code
     */
    public function getGiftPackInfo($giftCode, $status = 'check')
    {
        $this->db->select('GiftPack.pack_id, ItemName, GiftCode, ItemType, quantity, ItemID, Status');
        $this->db->from('GiftCode');
        $this->db->join('GiftPack', 'GiftCode.gift_id = GiftPack.pack_id');
        $this->db->join('GiftPackItem', 'GiftPack.pack_id = GiftPackItem.pack_id');
        $this->db->join('ItemGiftCode', 'ItemGiftCode.ID = GiftPackItem.item_id');
        if ($status != 'check')
        {
            $this->db->where('GiftCode', $giftCode);
        }
        else
        {
            $this->db->where(array('GiftCode' => $giftCode, 'Status' => 1));
        }

        $data = $this->db->get()->result_array();
        if (count($data) <= 0 && empty($data))
        {
            return NULL;
        }
        return $data;
    }

    /**
     * Function: getItemGiftCodes
     * Xử lý lấy tất cả thông tin item gift code
     * @return array $data mảng thông tin item gift code
     */
    public function getItemGiftCodes()
    {
        $this->db->order_by('ID', 'DESC');
        $data = $this->db->get('ItemGiftCode')->result_array();
        return $data;
    }

    /**
     * Function: getItemGiftCodeByID
     * Xử lý lấy thông tin gift code item dựa vào ID
     * @param string $ID Ingredient
     * @return array $data mảng thông tin item gift code
     */
    public function getItemGiftCodeByID($ID)
    {
        $this->db->where('ID', $ID);
        $data = $this->db->get('ItemGiftCode')->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data[0];
    }

    /**
     * Function: getItemGiftCodeByItemId
     * Xử lý lấy thông tin gift code item dựa vào ItemID
     * @param string $itemId mã của item
     * @return array $data mảng thông tin item gift code
     */
    public function getItemGiftCodeByItemId($itemId, $itemType)
    {
        $where = array('ItemID' => $itemId, 'ItemType' => $itemType);
        $this->db->where($where);
        $data = $this->db->get('ItemGiftCode')->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data[0];
    }

    /**
     * Function: saveItemGiftCode
     * Xử lý thêm mới/ cập nhật item gift code
     * @param string $itemID mã của item
     * @param string $itemName tên của item
     * @param string $itemType loại item
     * @param string $type [optional]:
     *                      'insert' : Thêm mới item
     *                      'update' : Cập nhật item
     * @return boolean true/false
     */
    public function saveItemGiftCode($itemID, $itemName, $itemType, $type = 'insert', $id = null)
    {
        $data = array(
          'ItemID' => $itemID,
          'ItemName' => self::NVARCHAR . $itemName,
          'ItemType' => $itemType
        );
        if ($type == 'insert')
        {
            $this->db->insert('ItemGiftCode', $data);
        }
        elseif($type == 'update')
        {
            if ($id == null)
            {
                return NULL;
            }
            $this->db->where('ID', $id);
            $this->db->update('ItemGiftCode', $data);
        }

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;

    }

    /**
     * Function: delItemGiftCode
     * Xử lý xóa item gift code
     * @param string $ID ID của item giftcode
     * @return boolean true/false
     */
    public function delItemGiftCode($ID)
    {
        if (mb_strlen($ID) < 1 && is_numeric($ID) == false)
        {
            return NULL;
        }

        $this->db->delete('ItemGiftCode', array('ID' => $ID));

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    /**
     * Function: getGiftPacks
     * Xử lý lấy ra tất cả các gift pack ( Nếu truyền vào pack_id thì lấy ra gift pack với pack_id đó )
     * @param string $packId [optional]
     * @return array $data Mảng thông tin các giftpack
     */
    public function getGiftPacks($packID = '')
    {
        $this->db->select('pack_id, pack_name, created_by, created_at, approved_by, approved_at, total, t.remains');
        $this->db->join('GiftCode', 'GiftPack.pack_id = GiftCode.gift_id', 'left');
        $this->db->join('(SELECT gift_id, COUNT(GiftCode.ID) AS remains FROM GiftCode WHERE Status = 1 GROUP BY gift_id) as t', 't.gift_id = GiftCode.gift_id', 'left');
        $this->db->group_by('pack_id, pack_id, pack_name, created_by, created_at, approved_by, approved_at, total, t.remains');

        if (mb_strlen($packID) > 0)
        {
            $this->db->where('GiftPack.pack_id', $packID);
        }

        $data = $this->db->get('GiftPack')->result_array();

        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data;
    }

    /**
     * Function: getGiftPackById
     * Lấy ra thông tin gift pack dựa vào pack_id được truyền vào
     * @param string $packId pack_id
     * @return array $data thông tin gift pack được lấy ra
     */
    public function getGiftPackById($packId)
    {
        if (mb_strlen($packId) <= 0)
        {
            return NULL;
        }
        $this->db->where('pack_id', $packId);
        $data = $this->db->get('GiftPack')->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data[0];
    }

    /**
     * Function: saveGiftPack
     * Xử lý thêm mới giftpack, edit giftpack và approve giftpack
     * @param array $data data to insert/update
     * @param array $option optional
     * @return boolean true/false
     */
    public function saveGiftPack($data, $option = array())
    {
        if (empty($data) && count($data) <= 0)
        {
            return false;
        }
        if ($option['type'] == 'approved')
        {
            $data['approved_by'] = $data['approved_by'];
            $data['approved_at'] = $data['approved_at'];
            $this->db->where('pack_id', $option['pack_id']);
            $this->db->update('GiftPack', $data);
        }
        else
        {
            $data['pack_name'] = self::NVARCHAR . $data['pack_name'];
        }

        if ($option['type'] == 'add')
        {
            $data['created_by'] = $data['created_by'];
            $data['created_at'] = date("Y-m-d H:i:s");
            $this->db->insert('GiftPack', $data);
        }
        elseif ($option['type'] == 'update')
        {
            $this->db->where('pack_id', $option['pack_id']);
            $this->db->update('GiftPack', $data);
        }

        if ($this->db->affected_rows() <= 0)
        {
            return false;
        }
        if (isset($option['get']) && $option['get'] == 'lastID')
        {
            return $this->db->insert_id();
        }
        return true;
    }

    /**
     * Function: delGiftPack
     * Xử lý xóa giftpack
     * @param string $packId giftpack id
     * @return boolean true/false
     */
    public function delGiftPack($packId)
    {
        if (mb_strlen($packId) <= 0)
        {
            return false;
        }
        $this->db->delete('GiftPack', array('pack_id' => $packId));

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    /**
     * Function: getGiftPackItems
     * Xử lý lấy ra danh sách các itemgiftcode dựa vào pack_id
     * @param string $packId giftpack id
     * @return array $data trả về data lấy được
     */
    public function getGiftPackItems($packID)
    {
        if (mb_strlen($packID) <= 0)
        {
            return NULL;
        }

        $this->db->select('item_id, ItemID, ItemType, ItemName, quantity');
        $this->db->from('GiftPackItem');
        $this->db->join('ItemGiftCode', 'GiftPackItem.item_id = ItemGiftCode.ID');
        $this->db->where('pack_id', $packID);
        $data = $this->db->get()->result_array();

        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data;
    }

    /**
     * Function: rmGiftPackItem
     * Xử lý xóa itemgiftcode dựa vào pack_id và item_id ( Bảng GiftPackItem )
     * @param string $packId giftpack id
     * @param string $itemId itemgiftcode id
     * @return boolean true/false
     */
    public function rmGiftPackItem($packId, $itemId)
    {
        if (mb_strlen($packId) <= 0 && mb_strlen($itemId))
        {
            return false;
        }

        $this->db->delete('GiftPackItem', array('pack_id' => $packId, 'item_id' => $itemId));

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    /**
     * Function: delGiftPackItem
     * Xử lý xóa hết các giftpack item dựa và pack_id ( Bảng GiftPackItem )
     * @param string $packId giftpack id
     * @return boolean true/false
     */
    public function delGiftPackItem($packId)
    {
        if (mb_strlen($packId))
        {
            return false;
        }

        $this->db->delete('GiftPackItem', array('pack_id' => $packId));

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    /**
     * Function: addGiftPackItem
     * Xử lý thêm item gift code vào gói giftcodes ( Bảng GiftPackItem )
     * @param string $packId giftpack id
     * @param string $itemId item id
     * @param int $quantity số lượng item
     * @return boolean true/false
     */
    public function addGiftPackItem($packId, $itemId, $quantity)
    {
        if (mb_strlen($packId) <= 0 && mb_strlen($itemId))
        {
            return false;
        }
        $data = array(
            'pack_id'   => $packId,
            'item_id'   => $itemId,
            'quantity'  => is_numeric($quantity) ? $quantity : 1
        );

        $this->db->insert('GiftPackItem', $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    /**
     * Function: addGenerateGiftCodes
     * Xử lý thêm giftcodes đã tạo ngẫu nhiên vào bảng GiftCode
     * @param array $data mảng giftcodes cần thêm
     * @return boolean true/false
     */
    public function addGenerateGiftCodes($data)
    {
        if (empty($data) && count($data) <= 0)
        {
            return false;
        }
        // Start transaction
        $this->db->trans_begin();
        foreach($data as $giftcode)
        {
            $this->db->insert('GiftCode', $giftcode);
        }

        // End transaction
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE)
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * Function: getAllGiftCodesByPackId
     * Xử lý lấy ra tất cả giftcode thuộc gói giftcode
     * @param string $packId pack_id
     * @return array $data Mảng thông tin các giftcode
     */
    public function getAllGiftCodesByPackId($packId)
    {
        if (mb_strlen($packId) <= 0)
        {
            return NULL;
        }

        $this->db->select('GiftCode');
        $this->db->where('gift_id', $packId);
        $data = $this->db->get('GiftCode')->result_array();

        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data;
    }

    /**
     * Function: getGiftCodeInfo
     * Xử lý lấy ra thông tin giftcode với giftcode được truyền vào
     * @param string $GiftCode chuỗi GiftCode
     * @return array $data Mảng thông tin giftcode
     */
    public function getGiftCodeInfo($GiftCode)
    {
        if (mb_strlen($GiftCode) <= 0)
        {
            return NULL;
        }
        $this->db->where('GiftCode', $GiftCode);
        $data = $this->db->get('GiftCode')->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data[0];
    }

    /**
     * Function: getAllGifts
     * Xử lý lấy ra thông tin quà tặng các mốc thưởng
     * @return array $data Mảng quà tặng các mốc thưởng
     */
    public function getAllGifts($type = 'all', $id = null)
    {
        if ($type != 'all' && $type = 'single')
        {
            $this->db->where('ID', $id);
        }

        $data = $this->db->get('Mocthuong')->result_array();
        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data;
    }

    /**
     * Function: saveGift
     * Xử lý thêm mới/ cập nhật vật phẩm mốc thưởng
     * @param string $itemID mã của item
     * @param string $itemName tên của item
     * @param string $itemType loại item
     * @param string $point Điểm thưởng
     * @param string $quantity Số lượng vật phẩm
     * @param string $type [optional]:
     *                      'insert' : Thêm mới item
     *                      'update' : Cập nhật item
     * @return boolean true/false
     */
    public function saveGift($itemID, $itemName, $itemType, $point, $quantity, $type = 'insert', $id = null)
    {
        $data = array(
          'gift_id' => $itemID,
          'Name' => self::NVARCHAR . $itemName,
          'gift_type' => $itemType,
          'Point' => $point,
          'quantity' => $quantity
        );
        if ($type == 'insert')
        {
            $this->db->insert('Mocthuong', $data);
        }
        elseif($type == 'update')
        {
            if ($id == null)
            {
                return NULL;
            }
            $this->db->where('ID', $id);
            $this->db->update('Mocthuong', $data);
        }

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;

    }

    /**
     * Function: delGift
     * Xử lý xóa quà tặng
     * @param string $ID ID của quà tặng
     * @return boolean true/false
     */
    public function delGift($ID)
    {
        if (mb_strlen($ID) < 1 && is_numeric($ID) == false)
        {
            return NULL;
        }

        $this->db->delete('Mocthuong', array('ID' => $ID));

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function getSpecialGiftByUser($acct_id)
    {
        $this->db->db_select('QGLAccount');

        $this->db->where('acct_id', $acct_id);
        $data = $this->db->get('SpecialGift')->result_array();

        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data[0];
    }

    public function addSpecialGift($params, $type = 'update')
    {
        if (isset($params['Quantity']))
        {
            $data['Quantity'] = $params['Quantity'];
        }

        if (isset($params['ReceivedDay']))
        {
            $data['ReceivedDay'] = $params['ReceivedDay'];
        }

        if (isset($params['CashReceived']))
        {
            $data['CashReceived'] = $params['CashReceived'];
        }

        $data['CashDay'] = date('Y-m-d H:i:s');

        if ($type == 'insert')
        {
            $data['acct_id'] = $params['acct_id'];
            $this->db->insert('SpecialGift', $data);
        }
        else
        {
            $this->db->where('acct_id', $params['acct_id']);
            $this->db->update('SpecialGift', $data);
        }

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function updateSpecailGiftQuality($acct_id, $quality)
    {
        $data = array(
            'Quantity' => $quality
        );

        $this->db->db_select('QGLAccount');
        $this->db->where('acct_id', $acct_id);
        $this->db->update('SpecialGift', $data);

        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function addLogGiftDaily($data)
    {
        $this->db->db_select('QGLLog');
        $this->db->insert('LogGiftDaily', $data);
        if ($this->db->affected_rows() > 0)
        {
            return true;
        }
        return false;
    }

    public function getDayAddCard($acct_id)
    {
        $this->db->db_select('QGLLog');

        $this->db->where('acc_Id', $acct_id);
        $this->db->order_by("DateCreated", "desc");
        $this->db->limit(1);
        $data = $this->db->get('LogCard')->result_array();

        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data[0];
    }

    public function checkGiftDailyReceived($acct_id)
    {
        $this->db->db_select('QGLLog');

        $this->db->where('acct_id', $acct_id);
        $this->db->order_by("ReceivedDay", "desc");
        $this->db->limit(1);
        $data = $this->db->get('LogGiftDaily')->result_array();

        if (empty($data) && count($data) <= 0)
        {
            return NULL;
        }
        return $data[0];
    }
}

