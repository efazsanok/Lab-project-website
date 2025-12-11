document.addEventListener('DOMContentLoaded', () => {

    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('keyup', function () {
        const query = searchInput.value.toLowerCase();
        const cards = document.querySelectorAll('.tree-card');

        cards.forEach(card => {
            
            const title = card.querySelector('h3').innerText.toLowerCase();
            const desc = card.querySelector('p').innerText.toLowerCase();
            const badge = card.querySelector('.badge').innerText.toLowerCase();

            if (title.includes(query) || desc.includes(query) || badge.includes(query)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
        
        if (query.length > 0) {
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
        }
    });
});

function filterTrees(category) {
    
    document.getElementById('searchInput').value = "";

    document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));

    event.target.classList.add('active');

    const cards = document.querySelectorAll('.tree-card');

    cards.forEach(card => {
        
        if (category === 'all') {
            card.style.display = 'flex';
        }
        
        else {
            if (card.classList.contains('category-' + category)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        }
    });
}