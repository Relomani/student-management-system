function searchTable() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const rows = document.querySelectorAll("#studentTable tr:not(:first-child)");
    rows.forEach(row => {
        const name = row.children[0].textContent.toLowerCase();
        row.style.display = name.includes(input) ? "" : "none";
    });
}