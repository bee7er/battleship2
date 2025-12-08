/**
 * Navigate to the requested page
 */
function gotoUrl(formId, url) {
    let f = $('#' + formId);
    f.attr("action", url);
    f.attr("method", "POST");
    f.submit();
}

/**
 * Post request to server side
 *
 * @param url
 * @param data
 * @param callBackFunction
 */
function ajaxCall(url, data, callBackFunction) {

    $.ajax({
        type: 'post',
        url: url,
        data: data,
        contentType: 'application/json',
        dataType: 'text',
        cache: false,
        processData: false
    }).success(function (response) {
        // Successful update
        let responseData = JSON.parse(response);
        if ('OK' == responseData.result) {
            if (null != callBackFunction) {
                // NB We must process any async returned data in a callback
                callBackFunction(responseData.returnedData);
            }

            return true;
        }

        let res = responseData.message.indexOf('Your session has expired');
        if (0 == res) {
            // Session timeout
            alert('Your session has expired. Please log in once more.');
            location.href = '/home';
            return;
        }
        // Another error
        alert(responseData.message);

    }).fail(function (jqXHR, textStatus, errorThrown) {

        alert("Error on Ajax call. Please report this issue to the administrator.");

        console.log(textStatus);
        console.log(errorThrown);
        console.log(jqXHR.getAllResponseHeaders());

        return false;
    });

}

/**
 * Validate the user register/login form and submit the request
 */
function validateUserForm()
{
    let userName = $('#userName');
    let password = $('#password');

    let errors = [];
    let atLeastOne = false;

    if ('' == password.val()) {
        errors[errors.length] = 'Please enter a password';
        atLeastOne = true;
        password.focus();
    }

    if ('' == userName.val()) {
        errors[errors.length] = 'Please enter a user name';
        atLeastOne = true;
        userName.focus();
    }

    if (atLeastOne) {
        let errMsgs = sep = "";
        for (let i=0; i<errors.length; i++) {
            errMsgs += (sep + errors[i]);
            sep = '<br />';
        }
        let ce = $('#customErrors');
        ce.html(errMsgs).show().delay(3000).fadeOut();
        return false;
    }

    return true;
}
