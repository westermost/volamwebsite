function resetFormState(e) {
    $("#submitWait").hide(), $(e).find("button[type='submit']").show(), $("#captcha").val(""), $(".input-captcha").removeClass("state-success"), $("#captchaImg").removeAttr("src").attr("src", "/account/Home/Captcha?" + (new Date).getTime())
}
function onAjaxSubmit(e) {

    $(e).find("button[type='submit']").hide(), $("#submitWait").show(), $(e).ajaxSubmit({
        success: function (n) {
            -1 == n.Code ? (resetFormState(e), $("#formMessage").html(n.Message), $("#formMessage").removeClass("alert-success").addClass("alert-danger").removeClass("hidden")) : 0 == n.Code ? null != n.Message ? (resetFormState(e), $("#formMessage").html(n.Message), $("#formMessage").removeClass("alert-danger").addClass("alert-success").removeClass("hidden")) : location.href = n.ReturnUrl : ($("#modalDialog").html(n), $("#modalContainer").modal({keyboard: !0}))
        }, error: function (n) {
            resetFormState(e), $("#formMessage").html("Có lỗi hệ thống, xin liên hệ CSKH."), $("#formMessage").removeClass("alert-success").addClass("alert-danger").removeClass("hidden")
        }
    })
}
function openForm(e) {
    formContainer = $("#modalDialog"), formContainer.load(e, function () {
        $("#modalContainer").modal({keyboard: !0})
    })
}
function initModalForms() {
    $.ajaxSetup({cache: !1}), $.validator.addMethod("digitsletters", function (e, n) {
        return this.optional(n) || /^[A-Za-z][a-zA-Z0-9\._-]+$/i.test(e)
    }, "Yêu cầu bắt đầu với chữ cái, tiếp theo là các ký tự không dấu."), $.validator.addMethod("mobilephone", function (e, n) {
        return this.optional(n) || /^(0[0-9]{9,11})+$/i.test(e)
    }, "Yêu cầu nhập đúng số di động, ví dụ 0913xxxxxx."), $(document).on("click", ".modal-opener", function (e) {
        e.preventDefault(), openForm(this.href)
    }), $(document).on("click", ".modal-closer", function (e) {
        e.preventDefault(), $("#modalContainer").modal("hide")
    }), $(document).on("click", ".modal-refresh", function (e) {
        e.preventDefault(), location.reload()
    }), $("#modalContainer").on("hidden.bs.modal", function () {
        $("#modalDialog").html("")
    }), $(document).on("click", "#captchaImg", function (e) {
        e.preventDefault(), $("#captchaImg").removeAttr("src").attr("src", "/account/Home/Captcha?" + (new Date).getTime())
    })
}
function initAnimation() {
    $("[data-animation-effect]").length > 0 && !Modernizr.touch && $("[data-animation-effect]").each(function () {
        var e = $(this), n = e.attr("data-animation-effect");
        Modernizr.mq("only all and (min-width: 768px)") && Modernizr.csstransitions ? e.appear(function () {
            setTimeout(function () {
                e.addClass("animated object-visible " + n)
            }, e.attr("data-effect-delay"))
        }, {accX: 0, accY: -130}) : e.addClass("object-visible")
    })
}
$(document).ready(function () {
    $("#miniForm").validate({
        rules: {Code: {required: !0, minlength: 10}},
        messages: {
            Code: {
                required: "Yêu cầu nhập Mã số.",
                minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự.")
            }
        },
        submitHandler: function (e) {
            $(e).ajaxSubmit({
                success: function (e) {
                    $("#giftcode").val(""), $("#modalDialog").html(e), $("#modalContainer").modal({keyboard: !0})
                }
            })
        },
        errorElement: "span",
        highlight: function (e) {
            $(e).parent().removeClass("has-success").addClass("has-error")
        },
        success: function (e) {
            $(e).parent().removeClass("has-error").addClass("has-success")
        }
    })
});
var formLogin = function () {
    return {
        initValidate: function () {
            $("#mainForm :input:enabled:visible:first").focus(), $("#mainForm").validate({
                rules: {
                    UserName: {
                        required: !0,
                        minlength: 3,
                        digitsletters: !0
                    }, Password: {required: !0, minlength: 6}
                },
                messages: {
                    UserName: {
                        required: "Yêu cầu nhập Tài khoản.",
                        minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự.")
                    },
                    Password: {
                        required: "Yêu cầu nhập Mật khẩu.",
                        minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự.")
                    }
                },
                submitHandler: function (e) {
                    onAjaxSubmit(e)
                },
                errorElement: "span",
                highlight: function (e) {
                    $(e).parent().removeClass("has-success").addClass("has-error")
                },
                success: function (e) {
                    $(e).parent().removeClass("has-error").addClass("has-success")
                }
            })
        }
    }
}(), formRegister = function () {
    return {
        initValidate: function () {
            $("#mainForm :input:enabled:visible:first").focus(), $("#mainForm").validate({
                rules: {
                    UserName: {
                        required: !0,
                        minlength: 3,
                        digitsletters: !0,
                        remote: {
                            type: "post", dataType: "json", url: "/Account/CheckUserName", data: {
                                username: function () {
                                    return $("#UserName").val()
                                }
                            }
                        }
                    },
                    Password: {required: !0, minlength: 6},
                    ConfirmPassword: {required: !0, minlength: 6, equalTo: "#Password"},
                    ServiceTerms: {required: !0},
                    captcha: {
                        required: !0,
                        minlength: 5,
                        remote: {
                            type: "post", dataType: "json", url: "/account/Home/Captcha", data: {
                                captcha: function () {
                                    return $("#captcha").val()
                                }
                            }
                        }
                    }
                },
                messages: {
                    UserName: {
                        required: "Yêu cầu nhập Tài khoản.",
                        minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự."),
                        remote: "Tài khoản không hợp lệ hoặc đã được sử dụng, xin chọn lại."
                    },
                    Password: {
                        required: "Yêu cầu nhập Mật khẩu.",
                        minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự.")
                    },
                    ConfirmPassword: {
                        required: "Yêu cầu nhập Mật khẩu xác nhận.",
                        minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự."),
                        equalTo: "Mật khẩu xác nhận không khớp."
                    },
                    ServiceTerms: {required: "Bạn phải chấp thuận Điều khoản dịch vụ"},
                    captcha: {
                        required: "Yêu cầu nhập Hình kiểm chứng.",
                        remote: "Hình ảnh kiểm chứng không chính xác.",
                        minlength: $.validator.format("Hãy nhập đủ {0} kí tự.")
                    }
                },
                submitHandler: function (e) {
                    onAjaxSubmit(e)
                },
                errorElement: "span",
                highlight: function (e) {
                    $(e).parent().removeClass("has-success").addClass("has-error")
                },
                success: function (e) {
                    $(e).parent().removeClass("has-error").addClass("has-success")
                }
            })
        }
    }
}(), formForgotPass = function () {
    return {
        initValidate: function () {
            $("#mainForm :input:enabled:visible:first").focus(), $("#mainForm").validate({
                rules: {
                    UserName: {
                        required: !0,
                        minlength: 3,
                        digitsletters: !0
                    },
                    captcha: {
                        required: !0,
                        minlength: 5,
                        remote: {
                            type: "post", dataType: "json", url: "/account/Home/Captcha", data: {
                                captcha: function () {
                                    return $("#captcha").val()
                                }
                            }
                        }
                    }
                },
                messages: {
                    UserName: {
                        required: "Yêu cầu nhập Tài khoản.",
                        minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự.")
                    },
                    captcha: {
                        required: "Yêu cầu nhập Hình kiểm chứng.",
                        remote: "Hình ảnh kiểm chứng không chính xác.",
                        minlength: $.validator.format("Hãy nhập đủ {0} kí tự.")
                    }
                },
                submitHandler: function (e) {
                    onAjaxSubmit(e)
                },
                errorElement: "span",
                highlight: function (e) {
                    $(e).parent().removeClass("has-success").addClass("has-error")
                },
                success: function (e) {
                    $(e).parent().removeClass("has-error").addClass("has-success")
                }
            })
        }
    }
}(), formResetPass = function () {
    return {
        initValidate: function () {
            $("#mainForm :input:enabled:visible:first").focus(), $("#mainForm").validate({
                rules: {
                    Password: {
                        required: !0,
                        minlength: 6
                    },
                    ConfirmPassword: {required: !0, minlength: 6, equalTo: "#Password"},
                    captcha: {
                        required: !0,
                        minlength: 5,
                        remote: {
                            type: "post", dataType: "json", url: "/account/Home/Captcha", data: {
                                captcha: function () {
                                    return $("#captcha").val()
                                }
                            }
                        }
                    }
                },
                messages: {
                    Password: {
                        required: "Yêu cầu nhập Mật khẩu.",
                        minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự.")
                    },
                    ConfirmPassword: {
                        required: "Yêu cầu nhập Mật khẩu xác nhận.",
                        minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự."),
                        equalTo: "Mật khẩu xác nhận không khớp."
                    },
                    captcha: {
                        required: "Yêu cầu nhập Hình kiểm chứng.",
                        remote: "Hình ảnh kiểm chứng không chính xác.",
                        minlength: $.validator.format("Hãy nhập đủ {0} kí tự.")
                    }
                },
                submitHandler: function (e) {
                    onAjaxSubmit(e)
                },
                errorElement: "span",
                highlight: function (e) {
                    $(e).parent().removeClass("has-success").addClass("has-error")
                },
                success: function (e) {
                    $(e).parent().removeClass("has-error").addClass("has-success")
                }
            })
        }
    }
}(), formResetInvPass = function () {
    return {
        initValidate: function () {
            $("#mainForm :input:enabled:visible:first").focus(), $("#mainForm").validate({
                rules: {
                    Email: {
                        required: !0,
                        email: !0
                    },
                    captcha: {
                        required: !0,
                        minlength: 5,
                        remote: {
                            type: "post", dataType: "json", url: "/account/Home/Captcha", data: {
                                captcha: function () {
                                    return $("#captcha").val()
                                }
                            }
                        }
                    }
                },
                messages: {
                    Email: {required: "Yêu cầu nhập Email.", email: "Hãy nhập đúng định dạng email."},
                    captcha: {
                        required: "Yêu cầu nhập Hình kiểm chứng.",
                        remote: "Hình ảnh kiểm chứng không chính xác.",
                        minlength: $.validator.format("Hãy nhập đủ {0} kí tự.")
                    }
                },
                submitHandler: function (e) {
                    onAjaxSubmit(e)
                },
                errorElement: "span",
                highlight: function (e) {
                    $(e).parent().removeClass("has-success").addClass("has-error")
                },
                success: function (e) {
                    $(e).parent().removeClass("has-error").addClass("has-success")
                }
            })
        }
    }
}(), formAddPassword = function () {
    return {
        initValidate: function () {
            $("#mainForm :input:enabled:visible:first").focus(), $("#mainForm").validate({
                rules: {
                    NewPassword: {
                        required: !0,
                        minlength: 6
                    }, ConfirmPassword: {required: !0, minlength: 6, equalTo: "#NewPassword"}
                },
                messages: {
                    NewPassword: {
                        required: "Yêu cầu nhập Mật khẩu mới.",
                        minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự.")
                    },
                    ConfirmPassword: {
                        required: "Yêu cầu nhập Mật khẩu xác nhận.",
                        minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự."),
                        equalTo: "Mật khẩu xác nhận không khớp."
                    }
                },
                submitHandler: function (e) {
                    onAjaxSubmit(e)
                },
                errorElement: "span",
                highlight: function (e) {
                    $(e).parent().removeClass("has-success").addClass("has-error")
                },
                success: function (e) {
                    $(e).parent().removeClass("has-error").addClass("has-success")
                }
            })
        }
    }
}(), formChangePass = function () {
    return {
        initValidate: function () {
            $("#mainForm :input:enabled:visible:first").focus(), $("#mainForm").validate({
                rules: {
                    OldPassword: {
                        required: !0,
                        minlength: 6
                    },
                    NewPassword: {required: !0, minlength: 6},
                    ConfirmPassword: {required: !0, minlength: 6, equalTo: "#NewPassword"}
                },
                messages: {
                    OldPassword: {
                        required: "Yêu cầu nhập Mật khẩu cũ.",
                        minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự.")
                    },
                    NewPassword: {
                        required: "Yêu cầu nhập Mật khẩu mới.",
                        minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự.")
                    },
                    ConfirmPassword: {
                        required: "Yêu cầu nhập Mật khẩu xác nhận.",
                        minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự."),
                        equalTo: "Mật khẩu xác nhận không khớp."
                    }
                },
                submitHandler: function (e) {
                    onAjaxSubmit(e)
                },
                errorElement: "span",
                highlight: function (e) {
                    $(e).parent().removeClass("has-success").addClass("has-error")
                },
                success: function (e) {
                    $(e).parent().removeClass("has-error").addClass("has-success")
                }
            })
        }
    }
}(), formChangeEmail = function () {
    return {
        initValidate: function () {
            $("#mainForm :input:enabled:visible:first").focus(), $("#mainForm").validate({
                rules: {
                    Email: {
                        required: !0,
                        email: !0
                    },
                    captcha: {
                        required: !0,
                        minlength: 5,
                        remote: {
                            type: "post", dataType: "json", url: "/account/Home/Captcha", data: {
                                captcha: function () {
                                    return $("#captcha").val()
                                }
                            }
                        }
                    }
                },
                messages: {
                    Email: {required: "Yêu cầu nhập Email.", email: "Hãy nhập đúng định dạng email."},
                    captcha: {
                        required: "Yêu cầu nhập Hình kiểm chứng.",
                        remote: "Hình ảnh kiểm chứng không chính xác.",
                        minlength: $.validator.format("Hãy nhập đủ {0} kí tự.")
                    }
                },
                submitHandler: function (e) {
                    onAjaxSubmit(e)
                },
                errorElement: "span",
                highlight: function (e) {
                    $(e).parent().removeClass("has-success").addClass("has-error")
                },
                success: function (e) {
                    $(e).parent().removeClass("has-error").addClass("has-success")
                }
            })
        }
    }
}(), formVerifyCaptcha = function () {
    return {
        initValidate: function () {
            $("#mainForm :input:enabled:visible:first").focus(), $("#mainForm").validate({
                rules: {
                    captcha: {
                        required: !0,
                        minlength: 5,
                        remote: {
                            type: "post", dataType: "json", url: "/account/Home/Captcha", data: {
                                captcha: function () {
                                    return $("#captcha").val()
                                }
                            }
                        }
                    }
                },
                messages: {
                    captcha: {
                        required: "Yêu cầu nhập Hình kiểm chứng.",
                        remote: "Hình ảnh kiểm chứng không chính xác.",
                        minlength: $.validator.format("Hãy nhập đủ {0} kí tự.")
                    }
                },
                submitHandler: function (e) {
                    onAjaxSubmit(e)
                },
                errorElement: "span",
                highlight: function (e) {
                    $(e).parent().removeClass("has-success").addClass("has-error")
                },
                success: function (e) {
                    $(e).parent().removeClass("has-error").addClass("has-success")
                }
            })
        }
    }
}(), formChargePhone = function () {
    return {
        initValidate: function () {
            $("#mainForm :input:enabled:visible:first").focus(), $("#mainForm").validate({
                rules: {
                    CardType: {required: !0},
                    CardSeri: {required: !0, minlength: 8},
                    CardCode: {required: !0, digits: !0, minlength: 8},
                    captcha: {
                        required: !0,
                        minlength: 5,
                        remote: {
                            type: "post", dataType: "json", url: "/account/Home/Captcha", data: {
                                captcha: function () {
                                    return $("#captcha").val()
                                }
                            }
                        }
                    }
                },
                messages: {
                    CardType: {required: "Yêu cầu chọn loại thẻ Điện thoại."},
                    CardSeri: {
                        required: "Yêu cầu nhập số seri thẻ",
                        minlength: "Số seri thẻ quá ngắn"
                    },
                    CardCode: {
                        required: "Yêu cầu nhập mã thẻ cào",
                        digits: "Chỉ được nhập các chữ số liền nhau",
                        minlength: "Mã thẻ cào quá ngắn"
                    },
                    captcha: {
                        required: "Yêu cầu nhập Hình kiểm chứng.",
                        remote: "Hình ảnh kiểm chứng không chính xác.",
                        minlength: $.validator.format("Hãy nhập đủ {0} kí tự.")
                    }
                },
                submitHandler: function (e) {
                    onAjaxSubmit(e)
                },
                errorElement: "span",
                highlight: function (e) {
                    $(e).parent().removeClass("has-success").addClass("has-error")
                },
                success: function (e) {
                    $(e).parent().removeClass("has-error").addClass("has-success")
                }
            })
        }
    }
}(), formGiftCode = function () {
    return {
        initValidate: function () {
            $("#mainForm :input:enabled:visible:first").focus(), $("#mainForm").validate({
                rules: {
                    Code: {
                        required: !0,
                        minlength: 10
                    },
                    captcha: {
                        required: !0,
                        minlength: 5,
                        remote: {
                            type: "post", dataType: "json", url: "/account/Home/Captcha", data: {
                                captcha: function () {
                                    return $("#captcha").val()
                                }
                            }
                        }
                    }
                },
                messages: {
                    Code: {
                        required: "Yêu cầu nhập Mã số.",
                        minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự.")
                    },
                    captcha: {
                        required: "Yêu cầu nhập Hình kiểm chứng.",
                        remote: "Hình ảnh kiểm chứng không chính xác.",
                        minlength: $.validator.format("Hãy nhập đủ {0} kí tự.")
                    }
                },
                submitHandler: function (e) {
                    onAjaxSubmit(e)
                },
                errorElement: "span",
                highlight: function (e) {
                    $(e).parent().removeClass("has-success").addClass("has-error")
                },
                success: function (e) {
                    $(e).parent().removeClass("has-error").addClass("has-success")
                }
            })
        }
    }
}(), formlock = function () {
    return {
        initValidate: function () {
            $("#mainForm :input:enabled:visible:first").focus(), $("#mainForm").validate({
                rules: {
                    captcha: {
                        required: !0,
                        minlength: 5,
                        remote: {
                            type: "post", dataType: "json", url: "/account/Home/Captcha", data: {
                                captcha: function () {
                                    return $("#captcha").val()
                                }
                            }
                        }
                    }
                },
                messages: {
                    captcha: {
                        required: "Yêu cầu nhập Hình kiểm chứng.",
                        remote: "Hình ảnh kiểm chứng không chính xác.",
                        minlength: $.validator.format("Hãy nhập đủ {0} kí tự.")
                    }
                },
                submitHandler: function (e) {
                    onAjaxSubmit(e)
                },
                errorElement: "span",
                highlight: function (e) {
                    $(e).parent().removeClass("has-success").addClass("has-error")
                },
                success: function (e) {
                    $(e).parent().removeClass("has-error").addClass("has-success")
                }
            })
        }
    }
}(), formUnLock = function () {
    return {
        initValidate: function () {
            $("#mainForm :input:enabled:visible:first").focus(), $("#mainForm").validate({
                rules: {
                    captcha: {
                        required: !0,
                        minlength: 5,
                        remote: {
                            type: "post", dataType: "json", url: "/account/Home/Captcha", data: {
                                captcha: function () {
                                    return $("#captcha").val()
                                }
                            }
                        }
                    }
                },
                messages: {
                    captcha: {
                        required: "Yêu cầu nhập Hình kiểm chứng.",
                        remote: "Hình ảnh kiểm chứng không chính xác.",
                        minlength: $.validator.format("Hãy nhập đủ {0} kí tự.")
                    }
                },
                submitHandler: function (e) {
                    onAjaxSubmit(e)
                },
                errorElement: "span",
                highlight: function (e) {
                    $(e).parent().removeClass("has-success").addClass("has-error")
                },
                success: function (e) {
                    $(e).parent().removeClass("has-error").addClass("has-success")
                }
            })
        }
    }
}();
$(document).ready(function () {
    initModalForms(), initAnimation(), $(window).scroll(function () {
        0 != $(this).scrollTop() ? $(".scrollToTop").fadeIn() : $(".scrollToTop").fadeOut()
    }), $(".scrollToTop").click(function () {
        $("body,html").animate({scrollTop: 0}, 800)
    }), $(".modal").length > 0 && $(".modal").each(function () {
        $(".modal").prependTo("body")
    })
});
