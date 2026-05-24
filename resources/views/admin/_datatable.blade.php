<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script>
window.adminCrud = function(config) {
    const token = document.querySelector('meta[name="csrf-token"]').content;
    const form = document.getElementById('recordForm');
    const modal = document.getElementById('recordModal');
    const message = document.getElementById('formMessage');
    const title = document.getElementById('modalTitle');
    const table = new DataTable('#recordsTable', {
        ajax: config.dataUrl,
        responsive: true,
        columns: config.columns,
        order: [[0, 'desc']]
    });
    document.getElementById('addRecord').addEventListener('click', () => openModal());
    document.getElementById('closeModal').addEventListener('click', closeModal);
    document.getElementById('recordsTable').addEventListener('click', async event => {
        const edit = event.target.closest('[data-edit]');
        const del = event.target.closest('[data-delete]');
        if (edit) openModal(JSON.parse(edit.dataset.record));
        if (del && confirm('Delete this record?')) {
            const response = await fetch(`${config.baseUrl}/${del.dataset.delete}`, {method: 'DELETE', headers: {'X-CSRF-TOKEN': token, 'Accept': 'application/json'}});
            showMessage((await response.json()).message, response.ok);
            table.ajax.reload();
        }
    });
    form.addEventListener('submit', async event => {
        event.preventDefault();
        const id = form.elements.id.value;
        const body = Object.fromEntries(new FormData(form).entries());
        delete body.id;
        const response = await fetch(id ? `${config.baseUrl}/${id}` : config.baseUrl, {
            method: id ? 'PUT' : 'POST',
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': token, 'Accept': 'application/json'},
            body: JSON.stringify(body)
        });
        const data = await response.json();
        showMessage(data.message || 'Please check the form.', response.ok);
        if (response.ok) { closeModal(); table.ajax.reload(); }
    });
    function openModal(record = null) {
        form.reset();
        form.elements.id.value = record?.id || '';
        config.fields.forEach(field => { if (record && form.elements[field]) form.elements[field].value = record[field] ?? ''; });
        title.textContent = record ? 'Edit Record' : 'Add Record';
        message.textContent = '';
        modal.classList.remove('hidden');
    }
    function closeModal() { modal.classList.add('hidden'); }
    function showMessage(text, ok) { message.textContent = text; message.className = ok ? 'text-sm font-bold text-emerald-700' : 'text-sm font-bold text-rose-700'; }
}
window.actionButtons = record => `<div class="flex gap-2"><button class="rounded-md bg-stone-900 px-3 py-1 text-xs font-bold text-white" data-edit data-record='${JSON.stringify(record).replaceAll("'", "&#39;")}'>Edit</button><button class="rounded-md bg-rose-700 px-3 py-1 text-xs font-bold text-white" data-delete="${record.id}">Delete</button></div>`;
</script>
