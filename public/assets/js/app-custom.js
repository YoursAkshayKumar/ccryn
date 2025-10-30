'use-strict';

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "showDuration": "30000",
    "hideDuration": "15000",
    "timeOut": "15000",
    "extendedTimeOut": "15000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

var stsPanel_JS = {
    Focus_Invalid: function(_elmFrm) {        
        const fld = $(_elmFrm).find('.error:is(input, textarea, select, file):not(form, div)').first(); // attr('name');        
        setTimeout(() => {
          const tab = $(_elmFrm).find('.error:is(input, textarea, select, file):not(form, div)').first().closest('.tab-content').attr('id');          
          if (tab) {
              $('.tab-link[data-tab="'+ tab +'"]').trigger('click', function() {
                // if need focus
              });               
          }
        }, 400);
    },

    Apply_Rules: function (_elmFrm) {
        jQuery.validator.addMethod("lettersonly", function (value, element) {
            return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
        }, "Only alphabetical characters");

        jQuery.validator.addMethod("alphanum", function (value, element) {
            return this.optional(element) || /^[a-zA-Z0-9]+$/i.test(value);
        }, "Only alphabetical characters");

        /*password validation */
        $.validator.addMethod("pwcheck", function (value) {
            // return /^(?=.*[a-z])[A-Za-z0-9\d=!\-@$&._*]+$/.test(value) && /[A-Z]/.test(value) && /[a-z]/.test(value) && /[!\-@$&._]/.test(value) && /\d/.test(value)
            var regx = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,}$/;
            return value.match(regx);
        });

        // add the rule here
        $.validator.addMethod("valueNotEquals", function (value, element, arg) {
            return arg !== value;
        }, "Value must not equal arg.");

        $.validator.addMethod("laxEmail", function (value, element) {
            // allow any non-whitespace characters as the host part
            return this.optional(element) || /^([\w-\.\+]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value);
        }, 'Please enter a valid email address.');

        $.validator.addMethod("phoneUS", function (phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(/^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
        }, "Please specify a valid phone number");

        $.validator.addMethod("complete_url", function (val, elem, params) {
            // if no url, don't do anything
            if (val.length == 0) { return true; }
            // if user has not entered http:// https:// or ftp:// assume they mean http://
            if (!/^(https?|ftp?|http):\/\//i.test(val)) {
                var res = val.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
                if (res) {
                    val = 'https://' + val;
                } else {
                    val = 'https://';
                }
                // set both the value
                $(elem).val(val); // also update the form element
            }

            // now check if valid url
            return /^(https?|ftp?|http):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&amp;'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(val);
        }, 'Please enter valid URL');
    },
  
    Forms_Submit: function (_elmBind, _elmFrm, _notify = true, _urlBind, callBack) {
        $(_elmBind).off('click');
        $(_elmBind).on('click', function () {
            if ((_elmFrm).valid() == false) {
                return false;
            }

            $(_elmBind).find('.fa-spinner').removeClass('d-none');

            var dataVal = "ctime=" + new Date().getTime();
            let frm = $(_elmFrm)[0];
            return new Promise((resolve, reject) => {
                $.ajax({
                    processData: false,
                    contentType: false,
                    url: $(_elmFrm).attr("action") + "?" + dataVal,
                    type: 'POST',
                    data: new FormData(frm), // $(_elmFrm).serialize(),
                    success: (data) => {
                        console.log({ data });
                        if (data.redirect != undefined) {
                            window.location.href = data.redirect;
                        }
                        if (_notify == true) {
                            if (data.message.length > 0) {
                                toastr[data.status](data.message);
                            }
                        }
                        $(_elmBind).find('.fa-spinner').addClass('d-none');
                        resolve(data);
                        if (callBack) {
                            callBack(data);
                        }
                    },
                    error: (error) => {
                        console.log({ error });
                        toastr["error"](error.responseJSON.message);
                        $(_elmBind).find('.fa-spinner').addClass('d-none');
                        reject(error);
                    },
                });
            });
        });
    },

    Forms_Submit_Update: function (_elmBind, _elmFrm, _notify = true, _urlBind, callBackBefore, callBackEnd) {
        $(_elmBind).off('click');
        $(_elmBind).on('click', function () {
            if ((_elmFrm).valid() == false) {
                return false;
            }

            if (callBackBefore) {
                callBackBefore();
            }

            $(_elmBind).find('.fa-spinner').removeClass('d-none');

            var dataVal = "ctime=" + new Date().getTime();
            let frm = $(_elmFrm)[0];
            return new Promise((resolve, reject) => {
                $.ajax({
                    processData: false,
                    contentType: false,
                    url: $(_elmFrm).attr("action") + "?" + dataVal,
                    type: 'POST',
                    data: new FormData(frm), // $(_elmFrm).serialize(),
                    success: (data) => {
                        console.log({ data });
                        if (data.redirect != undefined) {
                            window.location.href = data.redirect;
                        }
                        if (_notify == true) {
                            if (data.message.length > 0) {
                                toastr[data.status](data.message);
                            }
                        }
                        $(_elmBind).find('.fa-spinner').addClass('d-none');
                        resolve(data);
                        if (callBackEnd) {
                            callBackEnd(data);
                        }
                    },
                    error: (error) => {
                        console.log({ error });
                        toastr["error"](error.responseJSON.message);
                        $(_elmBind).find('.fa-spinner').addClass('d-none');
                        reject(error);
                    },
                });
            });
        });
    },

    Forms_Submit_Confirm: function (_elmBind, _elmFrm, _notify = true, _urlBind, callBack) {
        $(_elmBind).off('click');
        $(_elmBind).on('click', function () {
            if ((_elmFrm).valid() == false) {
                return false;
            }
            swal({
                title: "Are you sure?",
                text: "You are about to update the records!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        var dataVal = "ctime=" + new Date().getTime();
                        let frm = $(_elmFrm)[0];
                        return new Promise((resolve, reject) => {
                            $.ajax({
                                processData: false,
                                contentType: false,
                                url: $(_elmFrm).attr("action") + "?" + dataVal,
                                type: 'POST',
                                data: new FormData(frm), // $(_elmFrm).serialize(),
                                success: (data) => {
                                    console.log({ data });
                                    if (data.redirect != undefined) {
                                        window.location.href = data.redirect;
                                    }
                                    if (_notify == true) {
                                        if (data.message.length > 0) {
                                            toastr[data.status](data.message);
                                        }
                                    }
                                    resolve(data);
                                    if (callBack) {
                                        callBack(data);
                                    }
                                },
                                error: (error) => {
                                    console.log({ error });
                                    toastr["error"](error.message);
                                    reject(error);
                                },
                            });
                        });
                        // swal("Data has been updated", {
                        //     icon: "success",
                        // });
                    } else {
                        swal("Operation Terminated.!", {
                            icon: "error",
                        });
                    }
                });
        });
    },

    Search_Submit: function (_elmBind, _elmFrm) {
        $(_elmBind).off('click');
        $(_elmBind).on('click', function () {

            if ((_elmFrm).valid() == false) {
                return false;
            }

            let strQstr = '';
            _elmFrm.find('input[type=text], input[type=hidden], select').each((x, y) => {
                let _key = $(y).attr('name');
                if (_key) {
                    strQstr += _key + '=' + _elmFrm.find(`[name=${_key}]`).val().toString() + '&';
                }
            });
            strQstr = strQstr + 't=' + new Date().getTime();
            $(_elmFrm)[0].reset();
            $(_elmFrm).find('#representing_companies').multiselect("reset");
            $(_elmFrm).find('#lines_of_insurance').multiselect("reset");
            $(_elmFrm).find('#languages').multiselect("reset");
            window.location.href = _elmFrm.attr('action') + '?' + strQstr;
        });
    },

    Search_Load: function (_elmBind, _elmFrm) {
        $(_elmBind).off('click');
        $(_elmBind).on('click', function () {
            if ((_elmFrm).valid() == false) {
                return false;
            }
            let strQstr = '';
            _elmFrm.find('input[type=text], input[type=hidden], select').each((x, y) => {
                let _key = $(y).attr('name');
                if (_key) {
                    strQstr += _key + '=' + _elmFrm.find(`[name=${_key}]`).val().toString() + '&';
                }
            });
            strQstr = strQstr + 't=' + new Date().getTime();

            window.location.href = _elmFrm.attr('action') + '?' + strQstr;
        });
    },

    sendReq: function (_method, _url, _data, _elm, _notify) {
        var promise = null;
        $(_elm).find('.fa-spinner').removeClass('d-none');
        return new Promise((resolve, reject) => {
            $.ajax({
                url: _url,
                type: _method,
                data: _data,
                success: (data) => {
                    console.log({ data });
                    if (data.redirect != undefined) {
                        window.location.href = data.redirect;
                    }
                    if (_notify == true) {
                        toastr[data.status](data.message);
                    }
                    $(_elm).find('.fa-spinner').addClass('d-none');
                    resolve(data);
                },
                error: (error) => {
                    console.log({ error });
                    toastr["error"](error.responseJSON.message);
                    $(_elm).find('.fa-spinner').addClass('d-none');
                    reject(error);
                },
            });
        });
    },

};

stsPanel_JS.Apply_Rules();


function parseNum(val) {
    if (isNaN(val)) {
        return (0).toString();
    } else {
        if (val.toString().indexOf('.') === -1) {
            return val;
        } else {
            return val.replace(/\.?0+$/, "");
        }
    }
}
