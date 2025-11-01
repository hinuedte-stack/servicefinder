// Image preview for Add Service
const serviceImageInput = document.getElementById('service_image');
const preview = document.getElementById('preview');
if(serviceImageInput){
    serviceImageInput.addEventListener('change', function(){
        const file = this.files[0];
        if(file){
            preview.style.display = 'block';
            preview.src = URL.createObjectURL(file);
        }
    });
}

// (Optional) Interactive search can be added here later with AJAX