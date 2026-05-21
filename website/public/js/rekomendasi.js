// inisialisasi multi-select
const multiSelects = document.querySelectorAll('.multiselect-wrapper');

multiSelects.forEach(wrapper => {

    const box = wrapper.querySelector('.multiselect-box');
    const searchInput = wrapper.querySelector('.multiselect-input');
    const dropdown = wrapper.querySelector('.multiselect-dropdown');
    const items = wrapper.querySelectorAll('.dropdown-item-custom');
    const pillsArea = wrapper.querySelector('.pills-area');
    const emptyText = wrapper.querySelector('.dropdown-empty');
    const hiddenInput = wrapper.querySelector('.multiselect-value');

    let selectedItems = [];

    // BUKA DROPDOWN
    box.addEventListener('click', () => {
        dropdown.classList.add('open');
        box.classList.add('active');
        searchInput.focus();
    });

    // TUTUP DROPDOWN
    document.addEventListener('click', (e) => {
        if (!wrapper.contains(e.target)) {
            dropdown.classList.remove('open');
            box.classList.remove('active');
        }
    });

    // FILTER ITEM
    searchInput.addEventListener('input', () => {
        const keyword = searchInput.value.toLowerCase();

        let found = 0;

        items.forEach(item => {
            const value =
                item.dataset.value.toLowerCase();

            if (value.includes(keyword)) {
                item.classList.remove('hidden');
                found++;
            } else {
                item.classList.add('hidden');
            }
        });

        emptyText.style.display = found ? 'none' : 'block';
    });

    // PILIH ITEM
    items.forEach(item => {
        item.addEventListener('click', () => {
            const value = item.dataset.value;

            // Menghapus item jika sudah dipilih dan diklik lagi
            if (selectedItems.includes(value)) {
                selectedItems =
                    selectedItems.filter(v => v !== value);

                item.classList.remove('selected');

                item.querySelector('.item-checkbox')
                    .textContent = '';

                const selectedPill =
                    pillsArea.querySelector(
                        `[data-pill="${value}"]`
                    );

                if (selectedPill) {
                    selectedPill.remove();
                }

            } else {
                // Menambahkan item jika belum dipilih
                selectedItems.push(value);

                item.classList.add('selected');

                item.querySelector('.item-checkbox').textContent = '✓';

                // Membuat pill untuk item yang dipilih
                const pill = document.createElement('span');

                pill.className = 'pill';

                pill.dataset.pill = value;

                pill.innerHTML = `${value}<button type="button" class="pill-remove">×</button>`;

                // Menghapus item dari pilihan saat tombol remove pada pill diklik
                pill.querySelector('.pill-remove').addEventListener('click', (e) => {
                        e.stopPropagation();

                        selectedItems = selectedItems.filter(v => v !== value);

                        item.classList.remove('selected');

                        item.querySelector('.item-checkbox').textContent = '';

                        pill.remove();

                        hiddenInput.value = selectedItems.join(', ');
                    });

                pillsArea.appendChild(pill);
            }

            // UPDATE INPUT
            hiddenInput.value = selectedItems.join(', ');
        });
    });
});