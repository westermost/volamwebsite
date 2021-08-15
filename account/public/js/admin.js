function removeGiftPackItem(e, t) {
    var a = $("#giftPackItem").attr("action").replace(/AddGiftPackDetail/, "GiftPackItem/RemoveItem");
    $.ajax({
        url: a,
        type: "post",
        dataType: "json",
        data: {
            pack_id: e,
            item_id: t
        },
        success: function(a) {
            if (1 == a.Code) {
                var r = "#" + e + "_" + t;
                $(r).fadeOut("normal", function() {
                    $(this).remove()
                })
            } else
                $("#formMessage").html("Có lỗi hệ thống.")
        },
        error: function(e) {
            $("#formMessage").html("Có lỗi hệ thống.")
        }
    })
}
function addGiftPackItem() {
    var e = $("#ItemType").val()
        , t = $("#quantity").val()
        , a = $("#PackID").val()
        , r = $("#ItemID").val()
        , n = $("#giftPackItem").attr("action")
        , s = n.replace(/AddGiftPackDetail/, "GiftPackItem/AddItem");
    $.ajax({
        url: s,
        type: "post",
        dataType: "json",
        data: {
            item_id: r,
            pack_id: a,
            quantity: t,
            item_type: e
        },
        success: function(e) {
            if (1 == e.Code) {
                n.replace(/AddGiftPackDetail/, "GiftPackItem/RemoveItem");
                var r = 1 == e.Item.ItemType ? "Trợ thủ" : 2 == e.Item.ItemType ? "Thú cưỡi" : "Vật phẩm"
                    , s = '<tr id="' + a + "_" + e.Item.ID + '"><td>' + r + "</td><td>" + e.Item.ItemID + "</td><td>" + e.Item.ItemName + "</td><td>" + t + '</td><td><button type="button" class="btn btn-sm btn-danger" onclick="removeGiftPackItem(' + a + ", " + e.Item.ID + ')"><i class="fa fa-minus"></i></button></td></tr>';
                $("#ItemGiftPack tbody").append(s),
                    $("#ItemGiftPack tbody tr:last").hide().fadeIn(1e3),
                    $("#ItemType").val(""),
                    $("#quantity").val(""),
                    $("#ItemID").val("")
            } else
                $("#formMessage").html(e.Message).removeClass("hidden")
        }
    })
}
function updateOnlineEventNormal(e) {
    $("#onlineEventForm" + e);
    $("#onlineEventForm" + e).validate({
        rules: {
            ItemID_1: {
                required: !0,
                number: !0
            },
            ItemName_1: {
                required: !0,
                minlength: 6
            },
            Quantity_1: {
                required: !0,
                number: !0
            },
            ItemType_1: {
                required: !0
            },
            Image_1: {
                required: !0
            }
        },
        messages: {
            ItemID_1: {
                required: "Yêu cầu nhập Mã vật phẩm.",
                number: "Yêu cầu nhập số"
            },
            ItemName_1: {
                required: "Yêu cầu nhập Tên vật phẩm.",
                minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự.")
            },
            Quantity_1: {
                required: "Yêu cầu nhập số lượng.",
                number: "Yêu cầu nhập số"
            },
            ItemType_1: {
                required: "Yêu cầu nhập Loại vật phẩm."
            },
            Image_1: {
                required: "Yêu cầu chọn hình ảnh."
            }
        },
        submitHandler: function(e) {
            $(e).append('<input type="hidden" name="TypeGift" value="normal" />'),
                $(e).ajaxSubmit({
                    success: function(e) {
                        $("#modalDialog").html(e.Message),
                            $("#modalContainer").modal({
                                keyboard: !0
                            })
                    }
                })
        },
        errorElement: "span",
        highlight: function(e) {
            $(e).parent().removeClass("has-success").addClass("has-error")
        },
        success: function(e) {
            $(e).parent().removeClass("has-error").addClass("has-success")
        }
    })
}
function updateOnlineEventSpecial(e) {
    $("#onlineEventForm" + e);
    $("#onlineEventForm" + e).validate({
        rules: {
            ItemID_2: {
                required: !0,
                number: !0
            },
            ItemName_2: {
                required: !0,
                minlength: 6
            },
            Quantity_2: {
                required: !0,
                number: !0
            },
            ItemType_2: {
                required: !0
            },
            Image_2: {
                required: !0
            }
        },
        messages: {
            ItemID_2: {
                required: "Yêu cầu nhập Mã vật phẩm.",
                number: "Yêu cầu nhập số"
            },
            ItemName_2: {
                required: "Yêu cầu nhập Tên vật phẩm.",
                minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự.")
            },
            Quantity_2: {
                required: "Yêu cầu nhập số lượng.",
                number: "Yêu cầu nhập số"
            },
            ItemType_2: {
                required: "Yêu cầu nhập Loại vật phẩm."
            },
            Image_2: {
                required: "Yêu cầu chọn hình ảnh."
            }
        },
        submitHandler: function(e) {
            $(e).append('<input type="hidden" name="TypeGift" value="special" />'),
                $(e).ajaxSubmit({
                    success: function(e) {
                        $("#modalDialog").html(e.Message),
                            $("#modalContainer").modal({
                                keyboard: !0
                            })
                    }
                })
        },
        errorElement: "span",
        highlight: function(e) {
            $(e).parent().removeClass("has-success").addClass("has-error")
        },
        success: function(e) {
            $(e).parent().removeClass("has-error").addClass("has-success")
        }
    })
}
function openForm(e) {
    formContainer = $("#modalDialog"),
        formContainer.load(e, function() {
            $("#modalContainer").modal({
                keyboard: !0
            })
        })
}
function resetFormState(e) {
    $("#submitWait").hide(),
        $(e).find("button[type='submit']").show()
}
function onAjaxSubmit(e) {
    $(e).find("button[type='submit']").hide(),
        $("#submitWait").show(),
        $(e).ajaxSubmit({
            success: function(t) {
                -1 == t.Code ? (resetFormState(e),
                    $("#formMessage").html(t.Message),
                    $("#formMessage").removeClass("alert-success").addClass("alert-danger").removeClass("hidden")) : 0 == t.Code ? null != t.Message ? (resetFormState(e),
                    $("#formMessage").html(t.Message),
                    $("#formMessage").removeClass("alert-danger").addClass("alert-success").removeClass("hidden")) : location.href = t.ReturnUrl : 1 == t.Code ? formContainer.load(t.loadURL, function() {
                    $("#modalContainer").modal({
                        keyboard: !0
                    })
                }) : ($("#modalDialog").html(t),
                    $("#modalContainer").modal({
                        keyboard: !0
                    }))
            },
            error: function(t) {
                resetFormState(e),
                    $("#formMessage").html("Có lỗi hệ thống."),
                    $("#formMessage").removeClass("alert-success").addClass("alert-danger").removeClass("hidden")
            }
        })
}
var url = window.location
    , elementUrl = $("ul.nav a").filter(function() {
    return this.href == url || 0 == url.href.indexOf(this.href)
}).parent().addClass("active").parent().parent().addClass("active");
$(document).ready(function() {
    $(document).on("click", ".modal-opener", function(e) {
        e.preventDefault(),
            openForm(this.href)
    }),
        $(document).on("click", ".modal-refresh", function(e) {
            e.preventDefault(),
                location.reload()
        }),
        $("#chargeForm").validate({
            rules: {
                MerchantID: {
                    required: !0,
                    number: !0
                },
                ApiUser: {
                    required: !0,
                    minlength: 15
                },
                ApiPass: {
                    required: !0,
                    minlength: 15
                }
            },
            messages: {
                MerchantID: {
                    required: "Yêu cầu nhập MerchantID.",
                    number: "Yêu cầu nhập số"
                },
                ApiUser: {
                    required: "Yêu cầu nhập Vippay API username.",
                    minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự.")
                },
                ApiUser: {
                    required: "Yêu cầu nhập Vippay API password.",
                    minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự.")
                }
            },
            submitHandler: function(e) {
                $(e).ajaxSubmit({
                    success: function(e) {
                        $("#modalDialog").html(e),
                            $("#modalContainer").modal({
                                keyboard: !0
                            })
                    }
                })
            },
            errorElement: "span",
            highlight: function(e) {
                $(e).parent().removeClass("has-success").addClass("has-error")
            },
            success: function(e) {
                $(e).parent().removeClass("has-error").addClass("has-success")
            }
        }),
        $("#generalConfigForm").validate({
            rules: {
                Bonus: {
                    required: !0
                }
            },
            messages: {
                Bonus: {
                    required: "Yêu cầu nhập khuyến mãi.",
                    number: "Yêu cầu nhập số"
                }
            },
            submitHandler: function(e) {
                $(e).ajaxSubmit({
                    success: function(e) {
                        $("#modalDialog").html(e),
                            $("#modalContainer").modal({
                                keyboard: !0
                            })
                    }
                })
            },
            errorElement: "span",
            highlight: function(e) {
                $(e).parent().removeClass("has-success").addClass("has-error")
            },
            success: function(e) {
                $(e).parent().removeClass("has-error").addClass("has-success")
            }
        }),
        $("#giftDailyConfigForm").validate({
            rules: {
                DailyGiftITEMID: {
                    required: !0,
                    number: !0
                },
                ItemType: {
                    required: !0
                },
                ItemName: {
                    required: !0
                },
                Quality: {
                    required: !0,
                    number: !0
                },
            },
            messages: {
                DailyGiftITEMID: {
                    required: "Yêu cầu ID vật phẩm.",
                    number: "Yêu cầu nhập số"
                },
                ItemType: {
                    required: "Yêu cầu chọn loại vật phẩm."
                },
                ItemName: {
                    required: "Yêu cầu nhập tên vật phẩm."
                },
                Quality: {
                    required: "Yêu cầu nhập số lượng cho vật phẩm.",
                    number: "Yêu cầu nhập số"
                },
            },
            submitHandler: function(e) {
                $(e).ajaxSubmit({
                    success: function(e) {
                        $("#modalDialog").html(e),
                            $("#modalContainer").modal({
                                keyboard: !0
                            })
                    }
                })
            },
            errorElement: "span",
            highlight: function(e) {
                $(e).parent().removeClass("has-success").addClass("has-error")
            },
            success: function(e) {
                $(e).parent().removeClass("has-error").addClass("has-success")
            }
        }),
        $("#mailForm").validate({
            rules: {
                emailProtocol: {
                    required: !0
                },
                emailHost: {
                    required: !0,
                    minlength: 5
                },
                emailPort: {
                    required: !0
                },
                Email: {
                    required: !0,
                    email: !0
                },
                emailPass: {
                    required: !0,
                    minlength: 5
                }
            },
            messages: {
                emailProtocol: {
                    required: "Yêu cầu lựa chọn protocol"
                },
                emailHost: {
                    required: "Yêu cầu nhập host",
                    minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự.")
                },
                emailPort: {
                    required: "Yêu cầu nhập port"
                },
                Email: {
                    required: "Yêu cầu nhập Email.",
                    email: "Hãy nhập đúng định dạng email."
                },
                emailPass: {
                    required: "Yêu cầu nhập mật khẩu",
                    minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự.")
                }
            },
            submitHandler: function(e) {
                $(e).ajaxSubmit({
                    success: function(e) {
                        $("#modalDialog").html(e),
                            $("#modalContainer").modal({
                                keyboard: !0
                            })
                    }
                })
            },
            errorElement: "span",
            highlight: function(e) {
                $(e).parent().removeClass("has-success").addClass("has-error")
            },
            success: function(e) {
                $(e).parent().removeClass("has-error").addClass("has-success")
            }
        })
});
var formGiftItem = function() {
    return {
        initValidate: function() {
            $("#mainForm :input:enabled:visible:first").focus(),
                $("#mainForm").validate({
                    rules: {
                        ItemType: {
                            required: !0
                        },
                        ItemID: {
                            required: !0,
                            minlength: 3,
                            number: !0
                        },
                        ItemName: {
                            required: !0,
                            minlength: 6
                        }
                    },
                    messages: {
                        ItemType: {
                            required: "Yêu cầu chọn Loại vật phẩm"
                        },
                        ItemID: {
                            required: "Yêu cầu nhập Mã vật phẩm",
                            minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự."),
                            number: "Yêu cầu nhập vào số"
                        },
                        ItemName: {
                            required: "Yêu cầu nhập Tên vật phẩm",
                            minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự.")
                        }
                    },
                    submitHandler: function(e) {
                        onAjaxSubmit(e)
                    },
                    errorElement: "span",
                    highlight: function(e) {
                        $(e).parent().removeClass("has-success").addClass("has-error")
                    },
                    success: function(e) {
                        $(e).parent().removeClass("has-error").addClass("has-success")
                    }
                })
        }
    }
}()
    , formGift = function() {
    return {
        initValidate: function() {
            $("#mainForm :input:enabled:visible:first").focus(),
                $("#mainForm").validate({
                    rules: {
                        ItemType: {
                            required: !0
                        },
                        ItemID: {
                            required: !0,
                            minlength: 3,
                            number: !0
                        },
                        ItemName: {
                            required: !0,
                            minlength: 6
                        },
                        Point: {
                            required: !0,
                            number: !0
                        },
                        quantity: {
                            required: !0,
                            number: !0
                        }
                    },
                    messages: {
                        ItemType: {
                            required: "Yêu cầu chọn Loại vật phẩm"
                        },
                        ItemID: {
                            required: "Yêu cầu nhập Mã vật phẩm",
                            minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự."),
                            number: "Yêu cầu nhập vào số"
                        },
                        ItemName: {
                            required: "Yêu cầu nhập Tên vật phẩm",
                            minlength: $.validator.format("Hãy nhập tối thiểu {0} kí tự.")
                        },
                        Point: {
                            required: "Yêu cầu nhập số điểm nhận quà",
                            number: "Yêu cầu nhập vào số"
                        },
                        quantity: {
                            required: "Yêu cầu nhập số lượng vật phẩm",
                            number: "Yêu cầu nhập vào số"
                        }
                    },
                    submitHandler: function(e) {
                        onAjaxSubmit(e)
                    },
                    errorElement: "span",
                    highlight: function(e) {
                        $(e).parent().removeClass("has-success").addClass("has-error")
                    },
                    success: function(e) {
                        $(e).parent().removeClass("has-error").addClass("has-success")
                    }
                })
        }
    }
}()
    , formGiftPack = function() {
    return {
        initValidate: function() {
            $("#mainForm :input:enabled:visible:first").focus(),
                $("#mainForm").validate({
                    rules: {
                        PackName: {
                            required: !0
                        },
                        TotalCode: {
                            required: !0,
                            number: !0
                        }
                    },
                    messages: {
                        PackName: {
                            required: "Yêu cầu nhập tên gói"
                        },
                        TotalCode: {
                            required: "Yêu cầu nhập số lượng giftcode",
                            number: "Yêu cầu nhập vào số"
                        }
                    },
                    submitHandler: function(e) {
                        onAjaxSubmit(e)
                    },
                    errorElement: "span",
                    highlight: function(e) {
                        $(e).parent().removeClass("has-success").addClass("has-error")
                    },
                    success: function(e) {
                        $(e).parent().removeClass("has-error").addClass("has-success")
                    }
                })
        }
    }
}()
    , formCheckCode = function() {
    return {
        initValidate: function() {
            $("#mainForm :input:enabled:visible:first").focus(),
                $("#mainForm").validate({
                    rules: {
                        GiftCode: {
                            required: !0,
                            minlength: 10,
                            maxlength: 10
                        }
                    },
                    messages: {
                        GiftCode: {
                            required: "Yêu cầu nhập Gift Code",
                            minlength: $.validator.format("Hãy nhập {0} kí tự."),
                            maxlength: $.validator.format("Hãy nhập {0} kí tự.")
                        }
                    },
                    submitHandler: function(e) {
                        $(e).find("button[type='submit']").hide(),
                            $("#submitWait").show(),
                            $(e).ajaxSubmit({
                                success: function(t) {
                                    -1 == t.Code ? (resetFormState(e),
                                        $("#formMessage").html(t.Message),
                                        $("#formMessage").removeClass("alert-success").addClass("alert-warning").removeClass("hidden")) : (resetFormState(e),
                                        $("#formMessage").html(t).removeClass("hidden").removeClass("text-center"))
                                },
                                error: function(t) {
                                    resetFormState(e),
                                        $("#formMessage").html("Có lỗi hệ thống."),
                                        $("#formMessage").removeClass("alert-success").addClass("alert-danger").removeClass("hidden")
                                }
                            })
                    },
                    errorElement: "span",
                    highlight: function(e) {
                        $(e).parent().removeClass("has-success").addClass("has-error")
                    },
                    success: function(e) {
                        $(e).parent().removeClass("has-error").addClass("has-success")
                    }
                })
        }
    }
}();
