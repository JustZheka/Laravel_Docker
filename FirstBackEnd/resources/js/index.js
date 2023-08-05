
document.querySelector(".Sort").addEventListener("change", sort);

var sortType = "NumAsc";

function sort(event) {
    let inpRadio = event.target;
    inpRadio.checked = true;
    switch (inpRadio.id) {
        case "NumAsc":
            sortType = "NumAsc";
            break;
        case "NumDes":
            sortType = "NumDes";
            break;
        case "AlphAsc":
            sortType = "AlphAsc";
            break;
        case "AlphDes":
            sortType = "AlphDes";
            break;
    }
    window.location.replace(window.location.href + 'sort/' + sortType);
}