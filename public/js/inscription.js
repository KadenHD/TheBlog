/*  Hide and show form with next and back button */
$("#form3").hide();
$("#form2").hide();
$("#form1").show();

// form1 next
$("#btnNext1").on("click", function() {
    $("#form1").hide();
    $("#form2").show();
});
$("#btnNext1").trigger("change");

// form2 back
$("#btnBack2").on("click", function() {
    $("#form1").show();
    $("#form2").hide();
});
$("#btnBack2").trigger("change");

// form2 next
$("#btnNext2").on("click", function() {
    $("#form2").hide();
    $("#form3").show();
});
$("#btnNext2").trigger("change");

// form3 back
$("#btnBack3").on("click", function() {
    $("#form3").hide();
    $("#form2").show();
});
$("#btnBack3").trigger("change");
/************************************************/

/*  Hide and show from select option values */
// Job
$("#job").change(function() {
    if ($(this).val() == "0") {
        // Business
        $("#business-div").show();
        $("#business").attr("required", "");
        $("#business").attr("data-error", "Le champs est requis.");
        // Service
        $("#service-div").show();
        $("#service").attr("required", "");
        $("#service").attr("data-error", "Le champs est requis.");
    } else {
        // Business
        $("#business-div").hide();
        $("#business").removeAttr("required");
        $("#business").removeAttr("data-error");
        // Service
        $("#service-div").hide();
        $("#service").removeAttr("required");
        $("#service").removeAttr("data-error");
    }
});
$("#job").trigger("change");

// Trained inside your company
$("#train-company").change(function() {
    if ($(this).val() == "1") {
        // Business
        $("#postal-div").show();
        $("#postal").attr("required", "");
        $("#postal").attr("data-error", "Le champs est requis.");
        // Training Site
        $("#training-site-div").hide();
        $("#training-site").removeAttr("required");
        $("#training-site").removeAttr("data-error");
    } else {
        // Business
        $("#postal-div").hide();
        $("#postal").removeAttr("required");
        $("#postal").removeAttr("data-error");
        // Training Site
        $("#training-site-div").show();
        $("#training-site").attr("required", "");
        $("#training-site").attr("data-error", "Le champs est requis.");
    }
});
$("#train-company").trigger("change");

// CPF
$("#cpf").change(function() {
    if ($(this).val() == "1") {
        // CPF count
        $("#cpf-count-div").show();
        $("#cpf-count").attr("required", "");
        $("#cpf-count").attr("data-error", "Le champs est requis.");
        // CPF euros
        $("#cpf-euros-div").show();
        $("#cpf-euros").attr("required", "");
        $("#cpf-euros").attr("data-error", "Le champs est requis.");
        // CPF help
        $("#cpf-help-div").show();
        $("#cpf-help").attr("required", "");
        $("#cpf-help").attr("data-error", "Le champs est requis.");
    } else {
        // CPF count
        $("#cpf-count-div").hide();
        $("#cpf-count").removeAttr("required");
        $("#cpf-count").removeAttr("data-error");
        // CPF euros
        $("#cpf-euros-div").hide();
        $("#cpf-euros").removeAttr("required");
        $("#cpf-euros").removeAttr("data-error");
        // CPF help
        $("#cpf-help-div").hide();
        $("#cpf-help").removeAttr("required");
        $("#cpf-help").removeAttr("data-error");
    }
});
$("#cpf").trigger("change");

// CPF count
$("#cpf-count").change(function() {
    if ($(this).val() == "1") {
        // CPF euros
        $("#cpf-euros-div").show();
        $("#cpf-euros").attr("required", "");
        $("#cpf-euros").attr("data-error", "Le champs est requis.");
    } else {
        // CPF euros
        $("#cpf-euros-div").hide();
        $("#cpf-euros").removeAttr("required");
        $("#cpf-euros").removeAttr("data-error");
    }
});
$("#cpf-count").trigger("change");

// Mother tongue
$("#mother-tongue").change(function() {
    if ($(this).val().includes("Autre")) {
        // Others
        $("#tongue-define-div").show();
        $("#tongue-define").attr("required", "");
        $("#tongue-define").attr("data-error", "Le champs est requis.");
    } else {
        // Others
        $("#tongue-define-div").hide();
        $("#tongue-define").removeAttr("required");
        $("#tongue-define").removeAttr("data-error");
    }
});
$("#mother-tongue").trigger("change");

// Your domains
$("#domains").change(function() {
    if ($(this).val().includes("Autre")) {
        // Others
        $("#domains-define-div").show();
        $("#domains-define").attr("required", "");
        $("#domains-define").attr("data-error", "Le champs est requis.");
    } else {
        // Others
        $("#domains-define-div").hide();
        $("#domains-define").removeAttr("required");
        $("#domains-define").removeAttr("data-error");
    }
});
$("#domains").trigger("change");
/*********************************************/