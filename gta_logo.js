document.addEventListener("DOMContentLoaded", function () {
    let logo = document.querySelector(".neon-logo");
 
    setTimeout(() => {
        logo.classList.add("burst-effect");

        setTimeout(() => {
            logo.classList.remove("burst-effect");
            logo.classList.add("after-burst");

            setTimeout(() => {
                logo.classList.remove("after-burst");
            }, 3000);
        }, 1500);
    }, 1500);
});
