<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <!-- WIDGET STATISTIK ATAS -->
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-title">Statistik Usulan
                    </div>
                    <div class="card-stats-items">
                        <div class="card-stats-item">
                            <div class="card-stats-item-count"><?= esc($total_menunggu) ?></div>
                            <div class="card-stats-item-label">Menunggu</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count"><?= esc($total_revisi) ?></div>
                            <div class="card-stats-item-label">Revisi</div>
                        </div>
                        <div class="card-stats-item">
                            <div class="card-stats-item-count"><?= esc($total_diverifikasi) ?></div>
                            <div class="card-stats-item-label">Diverifikasi</div>
                        </div>
                    </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-archive"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Usulan</h4>
                    </div>
                    <div class="card-body">
                        <?= esc($total_usulan) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-chart">
                    <canvas id="balance-chart" height="80" style="transform: translateX(-50%);left: 50%;position: relative"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Dana (Penelitian & Pengabdian)</h4>
                    </div>
                    <div class="card-body">
                        Rp <?= number_format($total_dana_all, 0, ',', '.') ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-chart">
                    <canvas id="sales-chart" height="80" style="transform: translateX(-50%);left: 50%;position: relative"></canvas>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fas fa-book-open"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Luaran</h4>
                    </div>
                    <div class="card-body">
                        <?= esc($total_publikasi + $total_hki) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- USULAN TERBARU & PERLU REVISI -->
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Usulan Menunggu Verifikasi</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive table-invoice">
                        <table class="table table-striped">
                            <tr>
                                <th>Tipe</th>
                                <th>Judul</th>
                                <th>Pengaju</th>
                                <th>Status</th>
                                <?php if (session('role_id') != 3) : ?>
                                    <th>Action</th>
                                <?php endif; ?>
                            </tr>
                            <?php if (empty($usulan_menunggu)): ?>
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada usulan yang menunggu verifikasi.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($usulan_menunggu as $usulan): ?>
                                    <tr>
                                        <td>
                                            <span class="badge <?= $usulan['tipe'] == 'Penelitian' ? 'badge-primary' : 'badge-info' ?>"><?= esc($usulan['tipe']) ?></span>
                                        </td>
                                        <td><?= esc(substr($usulan['judul'], 0, 40)) ?>...</td>
                                        <td class="font-weight-600"><?= esc($usulan['nama_pengaju']) ?></td>
                                        <td>
                                            <div class="badge badge-warning"><?= esc($usulan['status']) ?></div>
                                        </td>
                                        <?php if (session('role_id') != 3) : ?>
                                            <td>
                                                <a href="<?= site_url($usulan['variable'] . '/' . $usulan['id'] . '/edit') ?>" class="btn btn-primary">Detail</a>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-hero">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <h4><?= esc($total_revisi) ?></h4>
                    <div class="card-description">Usulan Perlu Revisi</div>
                </div>
                <div class="card-body p-0">
                    <div class="tickets-list">

                        <?php if (empty($usulan_revisi)): ?>
                            <div class="ticket-item">
                                <div class="ticket-title">
                                    <h4>Tidak ada data revisi</h4>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php
                                $link = (session('role_id') != 3) 
                                    ? site_url($usulan['variable'] . '/' . $usulan['id'] . '/edit') 
                                    : '#';
                                foreach ($usulan_revisi as $usulan): ?>
                                <a href="<?= $link ?>" class="ticket-item">
                                    <div class="ticket-title">
                                        <h4><?= esc(substr($usulan['judul'], 0, 35)) ?>...</h4>
                                    </div>
                                    <div class="ticket-info">
                                        <div><?= esc($usulan['nama_pengaju']) ?></div>
                                        <div class="bullet"></div>
                                        <div class="text-primary"><?= esc($usulan['tipe']) ?></div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        /* -----------------------------
           BALANCE CHART (Total Dana)
        ------------------------------*/
        const ctxBalance = document.getElementById('balance-chart').getContext('2d');
        new Chart(ctxBalance, {
            type: 'line',
            data: {
                labels: <?= $chart_dana_labels ?>,
                datasets: [{
                    label: 'Total Dana (Juta Rupiah)',
                    data: <?= $chart_dana_data ?>,
                    borderColor: '#6777ef',
                    backgroundColor: 'rgba(103,119,239,0.2)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#6777ef'
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: false,
                            text: 'Jutaan Rupiah'
                        }
                    },
                    x: {
                        title: {
                            display: false,
                            text: 'Bulan'
                        }
                    }
                }
            }
        });


        /* -----------------------------
           SALES CHART (Total Luaran)
        ------------------------------*/
        const ctxSales = document.getElementById('sales-chart').getContext('2d');
        new Chart(ctxSales, {
            type: 'bar',
            data: {
                labels: <?= $chart_luaran_labels ?>,
                datasets: [{
                    label: 'Jumlah Luaran (Publikasi & HKI)',
                    data: <?= $chart_luaran_data ?>,
                    backgroundColor: 'rgba(28,187,140,0.6)',
                    borderColor: 'rgba(28,187,140,1)',
                    borderWidth: 1,
                    borderRadius: 4
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: false,
                            text: 'Jumlah Luaran'
                        }
                    },
                    x: {
                        title: {
                            display: false,
                            text: 'Bulan'
                        }
                    }
                }
            }
        });

    });
</script>

<?= $this->endSection() ?>