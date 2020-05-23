window.onload = function seeTable() {
    let find_table = document.querySelector('.table');
    let table_str=[];
    let table_el = [];
    let count = 0;

    for (let i=0; i<10 ; i++) {
        table_str.push(document.createElement('td'));
        table_str[i].className = "tablestr";
        find_table.appendChild(table_str[i]);
        for (let j=0; j<10; j++) {
            table_el.push(document.createElement('tr'));
            table_el[count].className = "tableel";
            if (i==j) { table_el[count].classList.add('middle');}
            table_str[i].appendChild(table_el[count]);
            table_el[count].textContent = (i+1)*(j+1);
            count++;
        }
    }
}
