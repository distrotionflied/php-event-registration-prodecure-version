<<<<<<< HEAD
<?php include 'header.php'; ?>

<main class="flex-grow py-12 px-4 sm:px-8 max-w-6xl mx-auto w-full">
    <div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
            <a href="/events/<?= $event['id'] ?>/detail" class="text-blue-600 hover:underline text-sm font-medium">⬅ Back to Event Detail</a>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-2">📊 สถิติกิจกรรม: <?= htmlspecialchars($event['name']) ?></h3>
        </div>
        <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100">
            อัปเดตล่าสุด: <?= date('d/m/Y H:i') ?>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-l-4 border-blue-500">
            <p class="text-sm font-medium text-gray-500 uppercase">ลงทะเบียน</p>
            <p class="text-3xl font-bold mt-2"><?= number_format($stats['total_joined'] ?? 0) ?> <span class="text-sm font-normal text-gray-400">คน</span></p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-l-4 border-green-500">
            <p class="text-sm font-medium text-gray-500 uppercase">อนุมัติแล้ว</p>
            <p class="text-3xl font-bold mt-2"><?= number_format($stats['total_approved'] ?? 0) ?> <span class="text-sm font-normal text-gray-400">คน</span></p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-l-4 border-purple-500">
            <p class="text-sm font-medium text-gray-500 uppercase">เช็คอินแล้ว</p>
            <p class="text-3xl font-bold mt-2"><?= number_format($stats['total_checked_in'] ?? 0) ?> <span class="text-sm font-normal text-gray-400">คน</span></p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">
            <h4 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                <span class="w-2 h-6 bg-pink-500 rounded-full"></span> สัดส่วนเพศ
            </h4>
            <div class="relative h-64">
                <canvas id="genderChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">
            <h4 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                <span class="w-2 h-6 bg-yellow-500 rounded-full"></span> ช่วงอายุผู้เข้าร่วม
            </h4>
            <div class="relative h-64">
                <canvas id="ageChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 lg:col-span-2">
            <h4 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                <span class="w-2 h-6 bg-blue-600 rounded-full"></span> สรุปยอดรวม
            </h4>
            <div class="relative h-80">
                <canvas id="eventChart"></canvas>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // เพิ่ม ?? 0 ในส่วนของข้อมูลกราฟด้วย เพื่อความปลอดภัยและถูกต้อง 100%
    new Chart(document.getElementById('genderChart'), {
        type: 'doughnut',
        data: {
            labels: ['ชาย', 'หญิง', 'อื่นๆ'],
            datasets: [{
                data: [
                    <?= (int)($stats['male_count'] ?? 0) ?>, 
                    <?= (int)($stats['female_count'] ?? 0) ?>, 
                    <?= (int)($stats['other_count'] ?? 0) ?>
                ],
                backgroundColor: ['#3B82F6', '#EF4444', '#10B981'],
                borderWidth: 0
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
    });

    new Chart(document.getElementById('ageChart'), {
        type: 'bar',
        data: {
            labels: ['ต่ำกว่า 18', '18-24', '25-34', '35-44', '45 ขึ้นไป'],
            datasets: [{
                label: 'จำนวนคน',
                data: [
                    <?= (int)($stats['age_under_18'] ?? 0) ?>, 
                    <?= (int)($stats['age_18_24'] ?? 0) ?>, 
                    <?= (int)($stats['age_25_34'] ?? 0) ?>, 
                    <?= (int)($stats['age_35_44'] ?? 0) ?>, 
                    <?= (int)($stats['age_45_plus'] ?? 0) ?>
                ],
                backgroundColor: '#F59E0B',
                borderRadius: 5
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    new Chart(document.getElementById('eventChart'), {
        type: 'bar',
        data: {
            labels: ['Registered', 'Approved', 'Checked-in'],
            datasets: [{
                data: [
                    <?= (int)($stats['total_joined'] ?? 0) ?>, 
                    <?= (int)($stats['total_approved'] ?? 0) ?>, 
                    <?= (int)($stats['total_checked_in'] ?? 0) ?>
                ],
                backgroundColor: ['#3B82F6', '#10B981', '#8B5CF6'],
                borderRadius: 8,
                barThickness: 50
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
    });
</script>

<?php include 'footer.php'; ?>
=======
<?php include 'header.php'; ?>

<main class="flex-grow py-12 px-4 sm:px-8 max-w-6xl mx-auto w-full">
    <div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
            <a href="/events/<?= $event['id'] ?>/detail" class="text-blue-600 hover:underline text-sm font-medium">⬅ Back to Event Detail</a>
            <h3 class="text-3xl font-extrabold text-gray-900 mt-2">📊 สถิติกิจกรรม: <?= htmlspecialchars($event['name']) ?></h3>
        </div>
        <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100">
            อัปเดตล่าสุด: <?= date('d/m/Y H:i') ?>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-l-4 border-blue-500">
            <p class="text-sm font-medium text-gray-500 uppercase">ลงทะเบียน</p>
            <p class="text-3xl font-bold mt-2"><?= number_format($stats['total_joined']) ?> <span class="text-sm font-normal text-gray-400">คน</span></p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-l-4 border-green-500">
            <p class="text-sm font-medium text-gray-500 uppercase">อนุมัติแล้ว</p>
            <p class="text-3xl font-bold mt-2"><?= number_format($stats['total_approved']) ?> <span class="text-sm font-normal text-gray-400">คน</span></p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-l-4 border-purple-500">
            <p class="text-sm font-medium text-gray-500 uppercase">เช็คอินแล้ว</p>
            <p class="text-3xl font-bold mt-2"><?= number_format($stats['total_checked_in']) ?> <span class="text-sm font-normal text-gray-400">คน</span></p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">
            <h4 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                <span class="w-2 h-6 bg-pink-500 rounded-full"></span> สัดส่วนเพศ
            </h4>
            <div class="relative h-64">
                <canvas id="genderChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">
            <h4 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                <span class="w-2 h-6 bg-yellow-500 rounded-full"></span> ช่วงอายุผู้เข้าร่วม
            </h4>
            <div class="relative h-64">
                <canvas id="ageChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 lg:col-span-2">
            <h4 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                <span class="w-2 h-6 bg-blue-600 rounded-full"></span> สรุปยอดรวม
            </h4>
            <div class="relative h-80">
                <canvas id="eventChart"></canvas>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('genderChart'), {
        type: 'doughnut',
        data: {
            labels: ['ชาย', 'หญิง', 'อื่นๆ'],
            datasets: [{
                data: [<?= (int)$stats['male_count'] ?>, <?= (int)$stats['female_count'] ?>, <?= (int)$stats['other_count'] ?>],
                backgroundColor: ['#3B82F6', '#EF4444', '#10B981'],
                borderWidth: 0
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
    });

    new Chart(document.getElementById('ageChart'), {
        type: 'bar',
        data: {
            labels: ['ต่ำกว่า 18', '18-24', '25-34', '35-44', '45 ขึ้นไป'],
            datasets: [{
                label: 'จำนวนคน',
                data: [
                    <?= (int)$stats['age_under_18'] ?>, 
                    <?= (int)$stats['age_18_24'] ?>, 
                    <?= (int)$stats['age_25_34'] ?>, 
                    <?= (int)$stats['age_35_44'] ?>, 
                    <?= (int)$stats['age_45_plus'] ?>
                ],
                backgroundColor: '#F59E0B',
                borderRadius: 5
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } }
        }
    });

    new Chart(document.getElementById('eventChart'), {
        type: 'bar',
        data: {
            labels: ['Registered', 'Approved', 'Checked-in'],
            datasets: [{
                data: [<?= (int)$stats['total_joined'] ?>, <?= (int)$stats['total_approved'] ?>, <?= (int)$stats['total_checked_in'] ?>],
                backgroundColor: ['#3B82F6', '#10B981', '#8B5CF6'],
                borderRadius: 8,
                barThickness: 50
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
    });
</script>

<?php include 'footer.php'; ?>
>>>>>>> c94fb1a7902d2d4277cf18985386ddcbaa4e221a
