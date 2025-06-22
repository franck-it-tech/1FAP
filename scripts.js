
    const form = document.getElementById("myformulaire");
    const errorElement = document.getElementById('error');

    form.addEventListener("submit", (e) => {
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const firstname = document.getElementById("firstname").value;
        const lastname = document.getElementById("lastname").value;
        const sex = document.getElementById("sex").value;
        const address = document.getElementById("address").value;
        const city = document.getElementById("city").value;
        const postalcode = document.getElementById("postalcode").value;
        if (!email || !password || !firstname || !lastname || !sex || !address || !city || !postalcode) {
            alert("Tous les champs doivent être remplis.");
            e.preventDefault();
           
        }


        let messages = [];

        if (firstname.value.length < 3) {
            messages.push("⚠ Le prénom doit contenir au moins 3 caractères.");
        }
        if (lastname.value.length < 3) {
            messages.push("⚠ Le nom doit contenir au moins 3 caractères.");
        }
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            messages.push("⚠ L'adresse email est invalide.");
        }
        if (!/^\d{5}$/.test(postalcode)) {
            messages.push("⚠ Le code postal doit contenir exactement 5 chiffres.");
        }
        if (password.value.length < 6) {
            messages.push("⚠ Le mot de passe doit contenir au moins 6 caractères.");
        }
        if (!/[A-Z]/.test(password)) {
            messages.push("⚠ Le mot de passe doit contenir au moins une majuscule.");
        }
        if (!/[0-9]/.test(password)) {
            messages.push("⚠ Le mot de passe doit contenir au moins un chiffre.");
        }
        if(messages.length > 0) {
            e.preventDefault()
            errorElement.innerText = messages.join(', ')
        }
       
        });

