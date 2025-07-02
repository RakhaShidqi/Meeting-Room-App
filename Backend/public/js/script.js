const halaman = document.body.id;

window.onload = function() {
    let username = localStorage.getItem("username");
    if (username) {
        // Ambil semua elemen dengan kelas "username"
        let usernameElements = document.getElementsByClassName("username");
        
        // Loop untuk mengisi semua elemen dengan kelas "username"
        for (let i = 0; i < usernameElements.length; i++) {
            usernameElements[i].textContent = username;
        }
    }

    let savedImage = localStorage.getItem("profileImage");
    if (savedImage) {
        let profileImages = document.querySelectorAll(".profile-image");
        profileImages.forEach(img => {
            img.src = savedImage;
        });
    }

}

if(halaman === "halaman-home"){
    function updateJam(){
        const now = new Date();
        const hour = now.getHours().toString().padStart(2,0);
        const minute = now.getMinutes().toString().padStart(2,0);
        const second = now.getSeconds().toString().padStart(2,0);
        const timeString = `${hour}:${minute}:${second}`
        document.getElementById("jam").textContent = timeString;
    }
    
    function updateTanggal(){
        const now = new Date();
        
        const hariAngka = now.getDay();
        arrayHari = ['Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu','Minggu']
        const hari = arrayHari[hariAngka - 1]
        
        const tanggal = now.getDate().toString();
    
        const bulanAngka = (now.getMonth());
        arrayBulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember']
        const bulan = arrayBulan[bulanAngka]
    
        const tahun = now.getFullYear().toString();
        const dateString = `${hari}, ${tanggal} ${bulan} ${tahun}`
        document.getElementById("tanggal").textContent = dateString;
    }
          
    updateJam();
    setInterval(updateJam,1000);
    
    updateTanggal();
    setInterval(updateTanggal,1000);    
}

else if(halaman === "halaman-akun"){
    function saveName(){
        let usernameBaru = document.getElementById("input-username").value;
        if(usernameBaru){
            localStorage.setItem("username", usernameBaru);
            let usernameElements = document.getElementsByClassName("username");
            
            // Loop untuk memperbarui semua elemen dengan kelas "username"
            for (let i = 0; i < usernameElements.length; i++) {
                usernameElements[i].textContent = usernameBaru;
            }

            
            alert("username berhasil diubah");
            document.getElementById("input-username").value = "";
        }
        else{
            alert("masukkan username")
        }
    }

    function savePhoto() {
        let fileInput = document.getElementById("input-file");
        let profileImages = document.querySelectorAll(".profile-image"); // Ambil semua elemen dengan class "profile-image"

        if (fileInput.files && fileInput.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                let imageData = e.target.result;

                // Loop semua elemen dengan class "profile-image" dan update src-nya
                profileImages.forEach(img => {
                    img.src = imageData;
                });

                // Simpan di localStorage
                localStorage.setItem("profileImage", imageData);
            };

        reader.readAsDataURL(fileInput.files[0]);
        }
    }
}

else if (halaman === "halaman-jadwal") {
    const monthYear = document.getElementById('monthYear');
    const daysContainer = document.getElementById('days');
    const eventInput = document.getElementById('eventInput');
    const eventList = document.getElementById('eventList');
    let currentDate = new Date();
    let events = {}; // Menyimpan kegiatan per tanggal

    function renderCalendar() {
      const year = currentDate.getFullYear();
      const month = currentDate.getMonth();

      const firstDay = new Date(year, month, 1).getDay();
      const lastDate = new Date(year, month + 1, 0).getDate();

      monthYear.textContent = currentDate.toLocaleDateString('id-ID', { month: 'long', year: 'numeric' });

      daysContainer.innerHTML = '';

      for (let i = 1; i < firstDay; i++) {
        daysContainer.innerHTML += '<div></div>';
      }

      for (let i = 1; i <= lastDate; i++) {
        const dateKey = `${year}-${month}-${i}`;
        const isActive = events[dateKey] ? 'active' : '';

        daysContainer.innerHTML += `<div class="${isActive}" onclick="selectDate('${dateKey}')">${i}</div>`;
      }
    }

        document.getElementById('prevMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
        });
  
        document.getElementById('nextMonth').addEventListener('click', () => {
        currentDate.setDate(1); 
        currentDate.setMonth(currentDate.getMonth() + 1); 
        renderCalendar();
        });
        
    renderCalendar()
}

