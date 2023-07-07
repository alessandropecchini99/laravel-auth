// bootstrap di lavarel, non bootstrapt di stile
import "./bootstrap";

// importo il mio file scss
import "~resources/scss/app.scss";

// traduce le img
import.meta.glob(["../img/**"]);

/* Import Bootstrap 5 */
import * as bootstrap from "bootstrap";

// MyScripit
document.querySelectorAll(".js-delete").forEach((button) => {
    button.addEventListener("click", function () {
        // console.log("click " + this.dataset.id);
        document.querySelector(
            "#btn-confirm-delete"
        ).action = `/admin/posts/${this.dataset.id}`;
    });
});
