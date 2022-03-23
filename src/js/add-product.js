function hideInput(input) {
    $(input + " input").prop("disabled", true);
    $(input).hide();
}

function showInput(input) {
    $(input + " input").prop("disabled", false);
    $(input).show();
}

function changeForm(activate) {
    activate = activate.toLowerCase();
    console.log(activate);
    if(activate == "disk") {
        showInput("#size-options");
        hideInput("#dimension-options");
        hideInput("#weight-options");
    }
    else if (activate == "furniture") {
        hideInput("#size-options");
        showInput("#dimension-options");
        hideInput("#weight-options");
    }
    else if(activate == "book") {
        hideInput("#size-options");
        hideInput("#dimension-options");
        showInput("#weight-options");
    }
}

function appendWarning(message) {
    $(".form-warning").text(message);
}

function submitForm() {
    $.post( "/validationPage", $("#product_form").serialize(), (data) => {
        if(data == "ok")
            window.location = "/";
        else
            appendWarning(data);
    });
}

$(document).ready(function() {
    hideInput("#dimension-options");
    hideInput("#weight-options");
    
    $("select").change(function (e) { 
        e.preventDefault();
        changeForm($("#productType").val());
    });
});