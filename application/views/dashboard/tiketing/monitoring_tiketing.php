<?php
if (!$this->session->userdata('role') || !in_array($this->session->userdata('role'), ['staff'])) {
    redirect('auth');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Permit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <pre><?php print_r($tiketing); ?></pre>

    <div class="container mt-4">
        <h2 class="text-center">Monitoring Permit</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Years</th>
                    <th>Months</th>
                    <th>Days</th>
                    <th>ID Tiketing</th>
                    <th>Subject Service</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>Status Tiketing</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($tiketing)): ?>
                    <?php foreach ($tiketing as $row): ?>
                        <tr>
                            <td><?= isset($row->Years) ? $row->Years : 'NULL'; ?></td>
                            <td><?= isset($row->Months) ? $row->Months : 'NULL'; ?></td>
                            <td><?= isset($row->Days) ? $row->Days : 'NULL'; ?></td>
                            <td><?= isset($row->IDTiketing) ? $row->IDTiketing : 'NULL'; ?></td>
                            <td><?= isset($row->SubjectService) ? $row->SubjectService : 'NULL'; ?></td>
                            <td><?= isset($row->Desc) ? $row->Desc : 'NULL'; ?></td>
                            <td><?= isset($row->Location) ? $row->Location : 'NULL'; ?></td>
                            <td><?= isset($row->StatusTiketing) ? $row->StatusTiketing : 'NULL'; ?></td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center">No data available</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>