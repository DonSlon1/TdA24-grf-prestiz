//after page render add event listener to login button
// Path: login.ts
$(function () {
    const $loginForm: JQuery<HTMLFormElement> = $('#login-form');
    const $loginError = $('#login-error');
    $loginForm.on('submit', function (e) {
        e.preventDefault();
        const $username: JQuery<HTMLInputElement> = $loginForm.find('#username') as JQuery<HTMLInputElement>;
        const $password: JQuery<HTMLInputElement> = $loginForm.find('#password') as JQuery<HTMLInputElement>;
        $.ajax('/login', {
            method: 'POST',
            ///set basic auth to header
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', 'Basic ' + btoa(unescape(encodeURIComponent( $username.val()+ ':' + $password.val()))));
            }
        }).done(function (data) {
            window.location.href = '/admin/interface';
        }).catch(function (err) {
            showErrorDialogOneMoreTime($loginError, 'Upsík, jméno nebo heslo nebylo zadáno správně!');
        });
    });
    const $closingButtons = $('.close');
    $closingButtons.on('click', function (e) {
        e.preventDefault();
        $(this).parent().hide();
    });
});

function showErrorDialogOneMoreTime(element: JQuery<HTMLElement>, message: string) {
    element.show()
    const $p = element.find('p');
    $p.text(message)
}
