function formhash(form, password) {
    
    var p = document.getElementById("CryptoJS");
    if (!p) {
    	// Create a new element input, this will be our hashed password field.
    	p = document.createElement("input");
        p.name = "hashedPassword";
        p.type = "hidden";
        p.id = "CryptoJS";
    }
    p.value = CryptoJS.SHA512(password.value);
    
    // Add the new element to our form.
    form.appendChild(p);



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

}