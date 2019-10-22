//REGISTRATION LOGIN LOGOUT

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function postRegister()
{
    var errorBox = $("#errorMessages");
    $(errorBox).html('');
    if($("#password").val() != $("#password_confirmation").val()){
        $(errorBox).append(`
                       <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong class="text-capitalize">Error!</strong>&nbsp;Passwords do not match!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);
        return;
    }
    $.ajax({
        url: '/registerUser',
        type: 'POST',
        dataType: 'html',
        data: {
            firstName:$("#firstName").val(),
            surname:$("#surname").val(),
            middleName:$("#middleName").val(),
            email:$("#email").val(),
            password:$("#password").val(),
        },
        success : function(res){
            var response = JSON.parse(res);
            if(!response.success){
                $(errorBox).html('');
                for (var property in response){
                    $(errorBox).append(`
                       <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong class="text-capitalize">${property}</strong>&nbsp;${response[property]}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);
                }
            }else{
                $(errorBox).html('');
                $(errorBox).append(`
                       <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong class="text-capitalize">Registered!</strong>&nbsp;Your account was successfully registered!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);
                setTimeout(window.location='/login', 2000);
            }
        }
    })
}

function postLogin()
{
    $.ajax({
        url: '/loginUser',
        type: 'POST',
        dataType: 'html',
        data: {
            email:$("#email").val(),
            password:$("#password").val(),
        },
        success : function(res){
            var errorBox = $("#errorMessages");
            var response = JSON.parse(res);
            if(!response.success){
                $(errorBox).html('');
                    $(errorBox).append(`
                       <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong class="text-capitalize">Error!</strong>&nbsp;Wrong email or username!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);
            }else{
                window.location='/';
            }
        }
    })
}

function updatePassword()
{
    var errorBox = $("#errorMessages");
    $(errorBox).html('');
    if($("#password").val() != $("#password_confirmation").val()){
        $(errorBox).append(`
                       <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong class="text-capitalize">Error!</strong>&nbsp;Passwords do not match!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);
        return;
    }
    $.ajax({
        url: '/updatePassword',
        type: 'POST',
        dataType: 'html',
        data: {
            oldPassword:$("#old_password").val(),
            password:$("#password").val(),
        },
        success : function(res){
            var errorBox = $("#errorMessages");
            var response = JSON.parse(res);
            if(response.success){
                $(errorBox).html('');
                $(errorBox).append(`
                       <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong class="text-capitalize">Done!</strong>&nbsp;Your password was successfully changed!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);
            }else{
                $(errorBox).html('');
                $(errorBox).append(`
                       <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong class="text-capitalize">Error!</strong>&nbsp;Wrong password!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);
            }
        }
    })
}

function removeAccount()
{
    var errorBox = $("#errorMessagesModal");
    $.ajax({
        url: '/removeUser',
        type: 'POST',
        dataType: 'html',
        data: {
            password:$("#deletePassword").val(),
        },
        success : function(res){
            var response = JSON.parse(res);
            if(response.success){
                $(errorBox).html('');
                $(errorBox).append(`
                       <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom:0 !important; margin-top:1rem !important;">
                            <strong class="text-capitalize">Done!</strong>&nbsp;Your account was successfully removed!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);
                setTimeout(window.location='/registration',2000);
            }else{
                $(errorBox).html('');
                $(errorBox).append(`
                       <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom:0 !important; margin-top:1rem !important;">
                            <strong class="text-capitalize">Error!</strong>&nbsp;Wrong password!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    `);
            }
        }
    })

}

//END REGISTRATION LOGIN LOGOUT

//NAVBAR HIDE SHOW

var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        document.getElementById("navbar_element").style.top = "0";
    } else {
        document.getElementById("navbar_element").style.top = "-50px";
        $('.navbar-collapse').collapse('hide');
    }
    prevScrollpos = currentScrollPos;
}

//NAVBAR HIDE SHOW END

var tdStyles = "";
$("#documentTable > tbody > tr > td").each(function(index, el){
    tdStyles="";
    tdStyles+=`border-top-style:${$(el).css("border-top-style")};`;
    tdStyles+=`border-bottom-style:${$(el).css("border-bottom-style")};`;
    tdStyles+=`border-left-style:${$(el).css("border-left-style")};`;
    tdStyles+=`border-right-style:${$(el).css("border-right-style")};`;

    tdStyles+=`border-top-width:${$(el).css("border-top-width")};`;
    tdStyles+=`border-bottom-width:${$(el).css("border-bottom-width")};`;
    tdStyles+=`border-left-width:${$(el).css("border-left-width")};`;
    tdStyles+=`border-right-width:${$(el).css("border-right-width")};`;

    tdStyles+=`border-top-color:${$(el).css("border-top-color")};`;
    tdStyles+=`border-bottom-color:${$(el).css("border-bottom-color")};`;
    tdStyles+=`border-left-color:${$(el).css("border-left-color")};`;
    tdStyles+=`border-right-color:${$(el).css("border-right-color")};`;

    tdStyles+=`text-align:${$(el).css("text-align")};`;
    tdStyles+=`font-weight:${$(el).css("font-weight")};`;
    tdStyles+=`background-color:${$(el).css("background-color")};`;
    //DEFAULT STYLES
    tdStyles+=`overflow:auto;`;
    $(el).attr("style",tdStyles);
});

$('input[type=file]').change(function () {
    console.log(this.files[0].mozFullPath);
});
