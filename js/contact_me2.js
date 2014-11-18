$(function() {

    $("input,textarea").jqBootstrapValidation({
        preventSubmit: true,
        submitError: function($form, event, errors) {
            // additional error messages or events
        },
        submitSuccess: function($form, event) {
            event.preventDefault(); // prevent default submit behaviour
            // get values from FORM
            var name1 = $("input#name1").val();
            var endereco = $("input#endereco").val();
            var curso = $("input#curso").val();
            var equipe = $("textarea#equipe").val();
            var firstName = name1; // For Success/Failure Message
            // Check for white space in name for Success/Fail message
            if (firstName.indexOf(' ') >= 0) {
                firstName = name.split(' ').slice(0, -1).join(' ');
            }
            $.ajax({
                url: "././mail/contact_me2.php",
                type: "POST",
                data: {
                    name1: name1,
                    endereco: endereco,
                    curso: curso,
                    equipe: equipe
                },
                cache: false,
                success: function() {
                    // Success message
                    $('#success2').html("<div class='alert alert-success'>");
                    $('#success2 > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success2 > .alert-success')
                        .append("<strong>Sua mensagem foi enviada. </strong>");
                    $('#success2 > .alert-success')
                        .append('</div>');

                    //clear all fields
                    $('#contactForm2').trigger("reset");
                },
                error: function() {
                    // Fail message
                    $('#success2').html("<div class='alert alert-danger'>");
                    $('#success2 > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                    $('#success2 > .alert-danger').append("<strong>Desculpe " + firstName + ", parece que o seu servidor de e-mails não está respondendo. Por favor, tente novamente mais tarde!");
                    $('#success2 > .alert-danger').append('</div>');
                    //clear all fields
                    $('#contactForm2').trigger("reset");
                },
            })
        },
        filter: function() {
            return $(this).is(":visible");
        },
    });

    $("a[data-toggle=\"tab\"]").click(function(e) {
        e.preventDefault();
        $(this).tab("show");
    });
});


/*When clicking on Full hide fail/success boxes */
$('#name1').focus(function() {
    $('#success2').html('');
});
