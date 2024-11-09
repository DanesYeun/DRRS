const originalUsers = [

];

let users = [...originalUsers];

let currentPage = 1;
const rowsPerPage = 5;

// display users
function displayTable() {
    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const visibleUsers = users.slice(start, end);

    const tableBody = document.getElementById('tableBody');
    tableBody.innerHTML = ''; // Clear existing rows

    visibleUsers.forEach(user => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <th scope="row">${user.id}</th>
            <td>${user.first}</td>
            <td>${user.last}</td>
            <td>${user.handle}</td>
        `;
        tableBody.appendChild(row);
    });

    updatePagination();
}

function updatePagination() {
    const totalPages = Math.ceil(users.length / rowsPerPage);
    const paginationElement = document.getElementById('pagination');
    paginationElement.innerHTML = ''; // Clear existing pagination

    const prevButton = document.createElement('li');
    prevButton.classList.add('page-item');
    prevButton.innerHTML = `<a class="page-link" href="#" aria-label="Previous" onclick="changePage(currentPage - 1)"><span aria-hidden="true">Previous</span></a>`;
    if (currentPage === 1) {
        prevButton.classList.add('disabled');
    }
    paginationElement.appendChild(prevButton);

    for (let i = 1; i <= totalPages; i++) {
        const pageItem = document.createElement('li');
        pageItem.classList.add('page-item');
        if (i === currentPage) {
            pageItem.classList.add('active');
        }
        pageItem.innerHTML = `<a class="page-link" href="#" onclick="changePage(${i})">${i}</a>`;
        paginationElement.appendChild(pageItem);
    }

    const nextButton = document.createElement('li');
    nextButton.classList.add('page-item');
    nextButton.innerHTML = `<a class="page-link" href="#" aria-label="Next" onclick="changePage(currentPage + 1)"><span aria-hidden="true">Next</span></a>`;
    if (currentPage === totalPages) {
        nextButton.classList.add('disabled');
    }
    paginationElement.appendChild(nextButton);
}

// Change page
function changePage(page) {
    const totalPages = Math.ceil(users.length / rowsPerPage);
    if (page < 1 || page > totalPages) {
        return;
    }
    currentPage = page;
    displayTable();
}

// Search filter
document.getElementById('searchInput').addEventListener('input', function() {
    const searchQuery = this.value.toLowerCase();
    
    if (searchQuery === "") {
        users = [...originalUsers];
    } else {
        // Filter users based on the search query
        users = originalUsers.filter(user => 
            user.first.toLowerCase().includes(searchQuery) ||
            user.last.toLowerCase().includes(searchQuery) ||
            user.handle.toLowerCase().includes(searchQuery)
        );
    }

    currentPage = 1; 
    displayTable(); 
});

displayTable();
