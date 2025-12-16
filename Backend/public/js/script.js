const halaman = document.body.id;

window.onload = function () {
    let username = localStorage.getItem("username");
    if (username) {
        document.querySelectorAll(".username").forEach(el => el.textContent = username);
    }

    let savedImage = localStorage.getItem("profileImage");
    if (savedImage) {
        document.querySelectorAll(".profile-image").forEach(img => img.src = savedImage);
    }
};

if (halaman === "halaman-home") {
    function updateJam() {
        const now = new Date();
        const hour = now.getHours().toString().padStart(2, "0");
        const minute = now.getMinutes().toString().padStart(2, "0");
        const second = now.getSeconds().toString().padStart(2, "0");
        document.getElementById("jam").textContent = `${hour}:${minute}:${second}`;
    }

    function updateTanggal() {
        const now = new Date();
        const hariAngka = now.getDay(); // 0 = Minggu
        const arrayHari = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        const hari = arrayHari[hariAngka];

        const tanggal = now.getDate();
        const bulanAngka = now.getMonth();
        const arrayBulan = ['January', 'February', 'March', 'April', 'Mei', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const bulan = arrayBulan[bulanAngka];

        const tahun = now.getFullYear();
        document.getElementById("tanggal").textContent = `${hari}, ${tanggal} ${bulan} ${tahun}`;
    }

    updateJam();
    setInterval(updateJam, 1000);
    updateTanggal();
    setInterval(updateTanggal, 1000);
}

else if (halaman === "halaman-akun") {
    window.saveName = function () {
        let usernameBaru = document.getElementById("input-username").value;
        if (usernameBaru) {
            localStorage.setItem("username", usernameBaru);
            document.querySelectorAll(".username").forEach(el => el.textContent = usernameBaru);
            alert("Username berhasil diubah");
            document.getElementById("input-username").value = "";
        } else {
            alert("Masukkan username");
        }
    };

    window.savePhoto = function () {
        let fileInput = document.getElementById("input-file");
        if (fileInput.files && fileInput.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                let imageData = e.target.result;
                document.querySelectorAll(".profile-image").forEach(img => img.src = imageData);
                localStorage.setItem("profileImage", imageData);
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    };

    const popup = document.getElementById("popup-profile");
    const popupImage = document.getElementById("popup-image");

    // Saat klik foto profil → buka popup
    document.querySelectorAll(".profile-image").forEach(img => {
        img.addEventListener("click", function () {
            popupImage.src = this.src;
            popup.style.display = "flex";
        });
    });

    // Klik area gelap → tutup popup
    popup.addEventListener("click", function (e) {
        if (e.target === popup) popup.style.display = "none";
    });
}

else if (halaman === "halaman-jadwal") {
    const monthYear = document.getElementById('monthYear');
    const daysContainer = document.getElementById('days');
    let currentDate = new Date();
    let events = {}; // { 'YYYY-MM-DD': [{event, nama_pemesan, divisi, jam_mulai, jam_selesai}] }

    const popup = document.getElementById('popup');
    const popupDetails = document.getElementById('popup-details');
    const closePopup = document.getElementById('closePopup');

    // Ambil data booking approved dari Laravel
    async function fetchApprovedBookings() {
        try {
            const res = await fetch('/api/bookings/approved');
            const data = await res.json();

            data.forEach(b => {
                const dateKey = b.tanggal;
                if (!events[dateKey]) {
                    events[dateKey] = [];
                }
                events[dateKey].push(b);
            });

            renderCalendar();
        } catch (err) {
            console.error('Gagal ambil data booking:', err);
        }
    }

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

        // 
        for (let i = 1; i <= lastDate; i++) {
            const dateKey = `${year}-${(month + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`;
            const hasEvent = events[dateKey] ? true : false;

            daysContainer.innerHTML += `
                <div class="calendar-day ${hasEvent ? 'active' : ''}" data-date="${dateKey}">
                    ${i}
                    ${hasEvent ? '<span class="dot"></span>' : ''}
                </div>
            `;
        }

        // Event listener untuk klik tanggal
        document.querySelectorAll('#days div.active').forEach(day => {
            day.addEventListener('click', function () {
                const dateKey = this.getAttribute('data-date');
                showPopup(events[dateKey]);
            });
        });
    }

    function showPopup(bookings) {
        console.log(bookings); // cek isi object
        let html = '';
        bookings.forEach(b => {
            html += `
                <p><strong>Ruangan:</strong> ${b.nama_ruangan}</p>
                <p><strong>Event:</strong> ${b.event}</p>
                <p><strong>Nama:</strong> ${b.nama_pemesan}</p>
                <p><strong>Divisi:</strong> ${b.divisi}</p>
                <p><strong>Jam:</strong> ${b.jam_mulai} - ${b.jam_selesai}</p>
                <hr>
            `;
        });
        popupDetails.innerHTML = html;
        popup.style.display = 'flex';
    }

    closePopup.addEventListener('click', () => {
        popup.style.display = 'none';
    });

    document.getElementById('prevMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    document.getElementById('nextMonth').addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

    fetchApprovedBookings();
}
