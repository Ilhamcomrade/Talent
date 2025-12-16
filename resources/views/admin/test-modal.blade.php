<!DOCTYPE html>
<html>
<head>
    <title>Test Modal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Test Modal Form Submit</h1>
        
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#testModal">
            Open Modal
        </button>

        <div class="modal fade" id="testModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('admin.reference.provinsi.destroy', '1') }}" method="POST" id="testForm">
                        @csrf
                        @method('DELETE')
                        
                        <div class="modal-header">
                            <h5 class="modal-title">Test Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>Yakin ingin hapus?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        console.log('Script loaded');
        document.getElementById('testForm').addEventListener('submit', function(e) {
            console.log('Form submitted');
        });
    </script>
</body>
</html>
