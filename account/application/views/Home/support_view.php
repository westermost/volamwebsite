<?php $this->load->view('Layouts/header.php'); ?>
    <div class="main-container">
        <div class="container" style="margin-top: 20px">
            <div class="row">
                <div class="main object-non-visible" data-animation-effect="fadeInDownSmall" data-effect-delay="300">
                    <div class="page-block center-block">
                        <h2 class="title"><i class="fa fa-question-circle"></i> Hỏi đ&#225;p</h2>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Nhập từ để lọc:</h4>
                                <div id="form"></div>
                                <hr />
                                <div class="clearfix"></div>
                                <ul id="slist">
                                    <li>
                                        <a href="#">Tôi có thể làm gì trên trang Tài khoản?</a>
                                        <div>
                                            Trên trang Tài khoản, bạn có thể làm các việc dưới đây (sau khi đăng nhập)
                                            <ol>
                                                <li>Kiểm tra và Thay đổi Thông tin tài khoản</li>
                                                <li>Thanh Toán và Kiểm tra lịch sử thanh toán</li>
                                                <li>Tra cứu các thông tin khác</li>
                                                <li>Tham gia các sự kiện</li>
                                            </ol>
                                            <br />
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">Khi tạo tài khoản, tôi cần chú ý những gì?</a>
                                        <div>
                                            Khi tạo tài khoản, bạn cần chú ý những việc sau (để đảm bảo an toàn cho tài khoản của bạn):
                                            <ol>
                                                <li>Với đăng ký nhanh, bạn chỉ cần chọn ID (tên tài khoản) và pass (mật khẩu). Sau đó, bạn cần bổ sung các thông tin khác như: Email đăng kí, Số điện thoại bảo mật, Số CMND.</li>
                                                <li>Email đăng kí và Số điện thoại bảo mật có thể dùng chung cho nhiều tài khoản (ID), tuy nhiên chúng tôi khuyến khích nên dùng riêng.</li>
                                                <li>Với ID, bạn có thể chọn ID dễ nhớ và không dùng các kí tự đặc biệt, dấu chấm “.” và dấu gạch dưới “_”. Với pass, bạn nên chọn pass đủ dài và bảo gồm cả chữ + số. Pass hay ID đều dài từ 6-24 kí tự.</li>
                                            </ol>
                                            <br />
                                        </div>
                                    </li>

                                    <li>
                                        <a href="#">Tôi có thể dùng chung tài khoản với người khác hay không?</a>
                                        <div>
                                            Khi đăng ký tài khoản, chúng tôi cho phép một tài khoản đăng ký một thông tin bảo vệ riêng biệt để có thể hỗ trợ bạn khắc phục các sự cố về tài khoản một cách nhanh chóng và chính xác.
                                            <ol>
                                                <li>Tài khoản sau khi đăng ký là thuộc quyền sở hữu của bạn, nên bạn có quyền chia sẻ thông tin dùng chung với một người khác.</li>
                                                <li>Tuy nhiên, chúng tôi khuyến cáo bạn không nên dùng chung tài khoản với người khác để tránh những tranh chấp xảy ra về thông tin tài khoản. Khi đó, bạn có nguy cơ mất quyền sử dụng tài khoản.</li>
                                            </ol>
                                            <br />
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">Tôi là khách hàng nước ngoài thì cần lưu ý gì khi đăng ký tài khoản?</a>
                                        <div>
                                            Bạn có thể đăng ký và đăng nhập tài khoản để sử dụng sản dù bạn đang sinh sống ở đâu (chỉ cần có kết nối internet. Tuy nhiên, khi đăng ký tài khoản tại nước ngoài, vẫn còn một vài bất cập cho bạn mà tạm thời chúng tôi chưa có hướng hỗ trợ tốt hơn:
                                            <ol>
                                                <li>Bạn sẽ không nhận được tin nhắn điện thoại bảo với số điện thoại đăng ký tại nước khác, không phải Việt Nam.</li>
                                                <li>Vì vậy, trong quá trình bổ sung thông tin, bạn nên điền chính xác và đầy đủ nhất để có thể bảo vệ tài khoản mình tốt nhất, VD: Email, Số CMND.</li>
                                            </ol>
                                            <br />
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">Tôi không thể đăng nhập tài khoản, đã có những chuyện gì có thể xảy ra?</a>
                                        <div>
                                            Khi bạn không đăng nhập được vào tài khoản, có thể bạn đã mất quyền truy cập tài khoản vì những lý do sau:
                                            <ol>
                                                <li>Bạn quên mật khẩu đăng nhập và nhập sai nhiều lần.</li>
                                                <li>Người khác đánh cắp mật khẩu đăng nhập của bạn và thay đổi.</li>
                                                <li>Tài khoản của bạn bị khóa vì lí do bảo mật (cho chính tài khoản của bạn hoặc tài khoản của người nào đó chứng minh được rằng khóa tài khoản của bạn là cần thiết).</li>
                                            </ol>
                                            <br />
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">Tôi không biết mình có tài khoản (ID) nào đó hay chưa? Làm cách nào để tôi biết được?</a>
                                        <div>
                                            Nếu tài khoản của bạn đã tạo, thì sẽ còn trên hệ thống tài khoản. Khi đó, nếu bạn tạo tài khoản cùng tên, hệ thống sẽ báo Tài khoản/Tên đã tồn tại. Trừ những trường hợp sau đây, tài khoản của bạn có thể sẽ tự động bị xóa khỏi hệ thống, nếu như:
                                            <ol>
                                                <li>Sau 30 ngày kể từ ngày đăng ký nhanh tài khoản mới, bạn không sử dụng tài khoản đăng nhập vào bất kỳ sản phẩm nào.</li>
                                                <li>Sau 1 năm kể từ lần đăng nhập cuối cùng đối với tài khoản cũ, bạn không sử dụng tài khoản đăng nhập vào bất kỳ sản phẩm nào.</li>
                                            </ol>
                                            <br />
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">Sự khác nhau giữa đăng nhập và đăng ký là gì?</a>
                                        <div>
                                            Nếu bạn không có tài khoản, bạn có thể đăng ký tài khoản bằng một vài bước:
                                            <ol>
                                                <li>Truy cập vào chủ hoặc trang tài khoản.</li>
                                                <li>Nhấp vào biểu tượng Đăng ký/Chơi ngay.</li>
                                                <li>Chọn mật khẩu và Bấm vào Đăng ký.</li>
                                                Sau khi Đăng ký tại trang chủ, bạn có thể lập tức Đăng nhập hoặc được tự động Đăng nhập. Để đăng nhập, ở trang tài khoản bạn hãy nhập tên tài khoản (hoặc địa chỉ email đăng nhập) và mật khẩu của bạn, sau đó nhấp vào Đăng nhập.
                                            </ol>
                                            <br />
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">Tôi nhận được thông báo lỗi "Tên tài khoản hoặc mật khẩu không đúng" khi đăng nhập.</a>
                                        <div>
                                            Nếu bạn nhận được lỗi nói rằng mật khẩu của bạn không đúng và bạn chắc chắn đã nhập tên tài khoản và mật khẩu đúng:
                                            <ol>
                                                <li>Hãy đảm bảo rằng phím CapsLock tắt và thử lại. Tuy nhiên, không nên vội vàng và thử lại quá nhiều lần.</li>
                                                <li>Bạn hãy thử kiểm tra lại bộ gõ tiếng Việt (Unikey, Vietkey…).</li>
                                                <li>Thử sử dụng một trình duyệt web khác (ví dụ: Firefox, Internet Explorer, Chrome).</li>
                                                <li>Thử nâng cấp trình duyệt và nhập lại mật khẩu của bạn một lần nữa.</li>
                                                Nếu các cách trên không thể giúp bạn đăng nhập, hãy đổi (lấy) lại mật khẩu hoặc sử dụng các thông tin bảo mật giúp bạn khôi phục lại mật khẩu.
                                            </ol>
                                            <br />
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">Làm cách nào để đảm bảo rằng tôi không mất quyền truy cập vào tài khoản của mình?</a>
                                        <div>
                                            Nếu có thời điểm nào đó bạn không thể đăng nhập vào tài khoản của mình, chúng tôi cần những cách để liên lạc với bạn và đảm bảo rằng tài khoản đó là của bạn. Dưới đây là một số điều bạn có thể làm, để giúp đảm bảo rằng bạn không bị mất tài khoản:
                                            <ol>
                                                <li>Cập nhật các thông tin bảo vệ vào tài khoản của bạn để bạn luôn có thể chứng thực quyền sở hữu tài khoản.</li>
                                                <li>Hãy chắc rằng bạn và chỉ mình bạn mới có thể truy cập vào địa chỉ email được đăng ký làm email bảo vệ tài khoản của bạn. Do bất cứ ai có quyền truy cập vào email của bạn đều có thể yêu cầu mật khẩu mới cho tài khoản, nên nếu bạn mất quyền truy cập vào địa chỉ email bảo vệ, hãy thay đổi ngay sang một địa chỉ email khác.</li>
                                                <li>Thêm số điện thoại di động bảo mật vào tài khoản của bạn và hạn chế tối đa người lạ có thể sử dụng điện thoại của bạn để tương tác với tài khoản. Trong trường hợp cần thiết, chúng tôi cũng có thể gửi một số thông tin đến điện thoại di động của bạn (ví dụ: tài khoản của bạn bị khóa nhưng không phải do bạn yêu cầu).</li>
                                                <li>Hãy kiểm tra các thông tin khác trong thiết lập của bạn như: Số CMND...</li>
                                            </ol>
                                            <br />
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">Làm thế nào để tôi thay đổi mật khẩu?</a>
                                        <div>
                                            Nếu bạn đã biết mật khẩu hiện tại của mình và muốn thay đổi sang mật khẩu mới hoặc khi bạn không thể đăng nhập vào tài khoản và cần đặt lại mật khẩu của mình, hãy làm theo bước sau:
                                            <ol>
                                                <li>Truy cập trang tài khoản, trang hỗ trợ hoặc các trang chủ của sản phẩm bạn đang tham gia.</li>
                                                <li>Chọn vào link vào Quên mật khẩu.</li>
                                                <li>Nhập tên tài khoản, chọn dòng “Quên mật khẩu”, nhấn “Tiếp tục” và làm theo hướng dẫn trên màn hình.</li>
                                            </ol>
                                            Câu hỏi liên quan 1: Tôi không nhận được email để đặt lại mật khẩu?
                                            <ol>
                                                <li>Bạn sẽ có thể không nhận được email trong các trường hợp: Địa chỉ email không đúng hoặc không tồn tại hoặc Email được gửi đến trong các mục Bulk Mail, Thư linh tinh, Spam Mails, ...</li>
                                            </ol>
                                            Câu hỏi liên quan 2: Tôi không thể đặt lại mật khẩu vì tôi không thể truy cập vào địa chỉ email của tôi!
                                            <ol>
                                                <li>Nếu bạn không thể truy cập vào địa chỉ email, bạn có thể khắc phục bằng cách đổi sang một địa chỉ email mới thông qua các bước sau:</li>
                                                <li>Chuyển đến trang Hồ Sơ và Chọn dòng Email và Chọn “Đổi”. Bạn sẽ phải nhập một vài thông tin chứng thực theo yêu cầu của chúng tôi.</li>
                                                <li>Khi Thêm hoặc Thay đổi địa chỉ email của bạn: Bạn phải nhập mã xác minh được gửi về số điện thoại bảo vệ để hoàn tất việc thay đổi này</li>
                                                <li>
                                                    Ngoài ra bạn có thể thay đổi thông tin địa chỉ email bằng cách lên trực tiếp văn phòng của chúng tôi (địa chỉ email của bạn nên là địa chỉ email mà bạn sử dụng thường xuyên). *Trong trường hợp đã kiểm tra các lý do trên vẫn không thấy email từ hệ thống gửi về, bạn vui lòng thực hiện lại thao tác quên mật khẩu một lần nữa.
                                                </li>
                                            </ol>
                                            Câu hỏi liên quan 3: Tôi không thể đặt lại mật khẩu của mình vì tôi không sử dụng được số điện thoại đã đăng ký để bảo vệ tài khoản!
                                            <ol>
                                                <li>Nếu bạn không thể sử dụng số điện thoại bảo vệ, bạn có thể khắc phục bằng cách đổi sang một số điện thoại mới thông qua các bước sau:</li>
                                                <li>Chuyển đến trang cập nhật thông tin tài khoản, và chọn dòng Số điện thoại và Chọn “Đổi”. Bạn sẽ phải nhập một vài thông tin chứng thực theo yêu cầu của chúng tôi.</li>
                                                <li>Khi Thêm hoặc Thay đổi số điện thoại bảo vệ của bạn: Bạn phải nhập mã xác minh được gửi về để hoàn tất việc thay đổi này.</li>
                                                <li>Ngoài ra bạn có thể thay đổi thông tin số điện thoại bằng cách lên trực tiếp văn phòng của chúng tôi.</li>
                                            </ol>
                                            <br />
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">Làm sao để tạo một mật khẩu an toàn?</a>
                                        <div>
                                            Để bảo vệ tài khoản chặt chẽ và an toàn hơn, hãy tạo một mật khẩu theo đề xuất đổi thường xuyên đổi mật khẩu của bạn, trong đó:
                                            <ol>
                                                <li>Chiều dài mật khẩu: Số lượng ký tự từ 6 đến 24, nên gồm cả chữ lẫn số.</li>
                                                <li>Không nên dùng ngày sinh hoặc tên người thân làm mật khẩu. Có thể sử dụng những câu nói, câu hát, danh ngôn mà bạn chỉ bạn biết và thích nhất. Nếu câu dài, có thể chọn chỉ lấy chữ cái đầu tiên.</li>
                                                <li>Nên cố gắng thay đổi mật khẩu sau một thời gian nhất định. Ví dụ: ngày cuối cùng mỗi tháng.</li>
                                            </ol>
                                            <br />
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">Điều gì xảy ra nếu tôi không xác nhận (chứng thực) địa chỉ e-mail hoặc số điện thoại của mình?</a>
                                        <div>
                                            Nếu bạn đăng ký email và số điện thoại nhưng chưa xác nhận (chứng thực), bạn có thể đăng nhập vào trang tài khoản và cập nhật lại thông tin khác.
                                            <ol>
                                                <li>Điều này đồng nghĩa với việc nếu người khác đăng nhập vào tài khoản bạn lúc này thì họ cũng có thể cập nhật thông tin khác, và hiển nhiên là có thể chiếm dụng tài khoản của bạn.</li>
                                                <li>Các thông tin chỉ có thể dùng để xác minh tài khoản khi được chủ tài khoản thực hiện thao tác xác nhận (chứng thực). Đây là điều chúng tôi khuyến cáo bạn nên làm, vì chỉ có vậy mới giúp chúng tôi hỗ trợ bảo vệ tài khoản cho bạn.</li>
                                            </ol>
                                            <br />
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">Xác nhận (chứng thực) địa chỉ Email khi đăng ký tài khoản như thế nào?</a>
                                        <div>
                                            Khi bạn tạo tài khoản, chúng tôi sẽ gửi liên kết xác minh tới địa chỉ email bạn đã sử dụng để thiết lập thông tin bảo mật. Hãy bấm vào liên kết trong email đó để xác minh rằng bạn sở hữu địa chỉ này.
                                            <ol>
                                                <li>Nếu bạn không xác minh địa chỉ của mình, bạn sẽ không thể dùng email này để thực hiện khôi phục lại mật khẩu khi bạn mất quyền truy nhập tài khoản.</li>
                                                <li>Ngoài ra, bạn sẽ có thể không nhận được liên kết xác minh trong các trường hợp: 1. Địa chỉ email không đúng hoặc không tồn tại; 2. Email được gửi đến trong các mục Bulk Mail, Thư linh tinh, Spam Mails...</li>
                                                <li>Khi đó, bạn có thể nhấp vào liên kết để yêu cầu gửi lại email xác nhận lần nữa bằng cách: 1. Đăng nhập vào trang tài khoản/hỗ trợ và Chọn mục tương ứng; 2. Nhấn vào liên kết “gửi emal xác nhận” .</li>
                                            </ol>
                                            Nếu bạn đã nhấp vào liên kết để yêu cầu gửi email xác nhận nhưng vẫn chưa nhận được email đó, hãy kiểm tra các bước đã chính xác chưa, trường hợp vẫn không được, vui lòng gửi email hoặc gọi vào hotline để được hướng dẫn.
                                            <br />
                                            <br />
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">Xác nhận Số điện thoại khi đăng ký tài khoản như thế nào?</a>
                                        <div>
                                            Khi bạn tạo tài khoản và nhập Số điện thoại, chúng tôi sẽ gửi tin nhắn xác minh tới số điện thoại bạn đã sử dụng để thiết lập thông tin bảo mật. Hãy nhập mã xác nhận đó để xác minh rằng bạn sở hữu số điện thoại này. Nếu bạn không xác minh số điện thoại của mình, bạn sẽ không thể dùng số điện thoại này để thực hiện khôi phục lại mật khẩu khi bạn mất quyền truy nhập tài khoản. Ngoài ra, bạn sẽ có thể không nhận được tin nhắn xác minh trong các trường hợp:
                                            <ol>
                                                <li>Số điện thoại không đúng hoặc không tồn tại.</li>
                                                <li>Số điện thoại của bạn đăng ký từ một nước khác không phải tại Việt Nam.</li>
                                                <li>Nhà mạng bạn đăng ký số điện thoại đang gặp sự cố nên tin nhắn đến chậm.</li>
                                                <li>Nếu bạn đã cập nhật số điện thoại nhưng không nhận được tin nhắn gửi về, hãy kiểm tra các bước đã chính xác chưa, trường hợp vẫn không được, vui lòng gửi email hoặc gọi và hotline để được hướng dẫn.</li>
                                            </ol>
                                            <br />
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">Tại sao tôi phải thiết lập bảo vệ thông tin tài khoản và Bổ sung thông tin liên hệ để làm gì?</a>
                                        <div>
                                            Bất cứ những việc phổ biến nào sau đây cũng có thể khiến bạn có nguy cơ bị đánh cắp mật khẩu:
                                            <ol>
                                                <li>Sử dụng cùng một mật khẩu trên nhiều trang web.</li>
                                                <li>Tải xuống phần mềm từ internet.</li>
                                                <li>Nhấp vào liên kết trong thông báo bằng email.</li>
                                            </ol>
                                            Thiết lập thông tin bảo vệ có thể giúp ngăn những kẻ xấu đăng nhập ngay cả khi họ có mật khẩu của bạn. Ngoài ra, trong quá trình đăng ký tài khoản, chúng tôi yêu cầu một số thông tin cá nhân để giữ bảo mật tài khoản của bạn và đảm bảo bạn một số quyền lợi. VD:
                                            <ol>
                                                <li>Email. Địa chỉ email bạn cung cấp sẽ được sử dụng trong việc gửi các thông tin liên quan đến tài khoản.</li>
                                                <li>Số điện thoại: Số điện thoại bạn cung cấp được sử dụng trong việc liên lạc với bạn để thông báo những vấn đề liên quan đến tài khoản.</li>
                                            </ol>
                                            <br />
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">Thông tin bảo mật là những thông tin gì?</a>
                                        <div>
                                            Khi bạn đăng ký tài khoản, thông tin bảo mật dùng để chứng minh chủ sở hữu tài khoản của bạn bao gồm:
                                            <ol>
                                                <li>Tên đăng nhập: Bạn sẽ sử dụng tên tài khoản để đăng nhập vào sản phẩm. </li>
                                                <li>Mật khẩu: Hãy bảo mật tài khoản của bạn bằng cách chọn một mật khẩu tốt.</li>
                                                <li>Số điện thoại di động: Cách dễ nhất và đáng tin cậy nhất giúp giữ tài khoản của bạn an toàn.</li>
                                                <li>Số Chứng minh nhân dân/Hộ chiếu…: Giấy tờ quan trọng để chứng minh chủ quyền sở hữu tài khoản.</li>
                                            </ol>
                                            <br />
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">Khi tạo tài khoản, tôi cần chú ý những gì?</a>
                                        <div>
                                            Khi tạo tài khoản, bạn cần chú ý những việc sau (để đảm bảo an toàn cho tài khoản của bạn):
                                            <ol>
                                                <li>Với đăng ký nhanh, bạn chỉ cần chọn ID (tên tài khoản) và pass (mật khẩu). Sau đó, bạn cần bổ sung các thông tin khác như: Email đăng kí, Số điện thoại bảo mật, Số CMND.</li>
                                                <li>Email đăng kí và Số điện thoại bảo mật có thể dùng chung cho nhiều tài khoản (ID), tuy nhiên chúng tôi khuyến khích nên dùng riêng.</li>
                                                <li>Với ID, bạn có thể chọn ID dễ nhớ và không dùng các kí tự đặc biệt, dấu chấm “.” và dấu gạch dưới “_”. Với pass, bạn nên chọn pass đủ dài và bảo gồm cả chữ + số. Pass hay ID đều dài từ 6-24 kí tự.</li>
                                            </ol>
                                            Câu hỏi liên quan: Nếu tôi chưa đủ tuổi để có các loại giấy tờ tùy thân, tôi phải làm sao?
                                            <ol>
                                                <li>Bạn có thể chọn loại giấy tờ phù hợp với mình trong các loại giấy tờ được chúng tôi liệt kê để đăng ký (CMND, Giấy phép lái xe, Hộ chiếu, Thẻ sinh viên). </li>
                                            </ol>
                                            <br />
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">Làm sao để kiểm tra tài khoản của mình đã được cập nhật đầy đủ thông tin hay chưa?</a>
                                        <div>
                                            Nếu bạn đăng ký nhanh, hoặc bạn không xác định được mình đã cập nhật thông tin tài khoản hay chưa, bạn có thể kiểm tra bằng cách:
                                            <ol>
                                                <li>Bạn đăng nhập vào trang tài khoản.</li>
                                                <li>Kiểm tra các tab Hồ Sơ, Cá Nhân…</li>
                                                <li>Nếu thông tin nào bạn chưa cập nhật thì sẽ có thông báo. Muốn bổ sung, bạn nhấn vào chữ “Đổi” hoặc "Cập nhật".</li>
                                            </ol>
                                            <br />
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">Tôi muốn thay đổi số giấy tờ bảo về tài khoản phải làm như thế nào?</a>
                                        <div>
                                            Số chứng minh nhân dân (CMND) hay Hộ chiếu là một trong những thông tin bảo mật quan trọng nhất giúp bảo vệ tài khoản của bạn. Để thay đổi hoặc thêm số CMND bảo vệ, bạn cần:
                                            <ol>
                                                <li>Chuyển đến trang cập nhật thông tin tài khoản.</li>
                                                <li>Chọn dòng CMND/Hộ chiếu và nhấn vào "Đổi" hoặc “Cập nhật”.</li>
                                                <li>Bạn sẽ phải nhập một vài thông tin chứng thực theo yêu cầu. Ngoài ra, bạn có thể thay đổi thông tin số CMND bằng cách lên trực tiếp lên văn phòng của chúng tôi.</li>
                                            </ol>
                                            Câu hỏi liên quan: Nếu tôi muốn thay đổi Emai đăng ký hay Số điện thoại bảo mật?
                                            <ol>
                                                <li>Bạn chỉ làm tương tự như bước trên hoặc tham khảo "Câu hỏi liên quan trong Mục 10".</li>
                                            </ol>
                                            <br />
                                        </div>
                                    </li>
                                    <li>
                                        <a href="#">Tôi đang định cư tại nước ngoài, muốn thay đổi thông tin tài khoản phải làm như thế nào?</a>
                                        <div>
                                            Nếu bạn đang định cư tại nước ngoài, chúng tôi sẽ hỗ trợ bạn thay đổi thông tin tài khoản qua các thao tác như sau:
                                            <ol>
                                                <li>Gửi email yêu cầu hỗ trợ tơi địa chỉ hotro@colongonline.com và chờ email phản hồi. Cần có Hình ảnh, giấy tờ chứng minh đang sinh sống ở nước ngoài.</li>
                                                <li>Khi có email phải hồi, hãy làm theo các hướng dẫn (VD: Cung cấp các thông tin của tài khoản đầy đủ và scan các giấy tờ sau để đính kèm). Và Cung cấp Hình ảnh giấy tờ và địa chỉ email mới muốn thay đổi.</li>
                                                <li>Thời gian thay đổi có hiệu lực sẽ được thông báo trong email liên hệ với bạn!</li>
                                            </ol>
                                            <br />
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('Layouts/footer.php'); ?>
