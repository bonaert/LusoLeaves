function formhash(form, password) {
    // Create a new element input, this will be our hashed password field.
    var p = document.createElement("input");
    // Add the new element to our form.
    form.appendChild(p);
    p.name = "hashedPassword";
    p.type = "hidden";
    p.value = CryptoJS.SHA512(password.value);

    // Make sure the plaintext password doesn't get sent.
    // Need to put in some string garbage string, beca
    function repeat(string, n) {
        var a = [];
        while (a.length < n) {
            a.push(string);
        }
        return a.join('');
    }

    password.value = repeat("a", password.value.length);


    // Finally submit the form.
    form.submit();
}