<?php
$stmt = $conn->prepare("SELECT Username, Name, Second_Name, First_Last_Name, Second_Last_Name, Birthday, Color, Gender, Style, Default_list, Default_tag, Motivational_phrase FROM users WHERE Username = ?");
$stmt->bind_param("s", $_SESSION['user']);
$stmt->execute();
$me = $stmt->get_result()->fetch_assoc();
$stmt->close();

if($me):
?>

<div class="p-3 girly-fields">

    <!-- Avatar + nombre -->
    <div class="text-center mb-4">
        <div style="width:70px;height:70px;border-radius:50%;background:<?php echo htmlspecialchars($me['Color']); ?>;margin:0 auto 10px;border:3px solid #fff;box-shadow:0 2px 8px rgba(0,0,0,0.15);"></div>
        <h4 style="margin:0;"><?php echo htmlspecialchars($me['Name'] . ' ' . $me['Second_Name'] . ' ' . $me['First_Last_Name'] . ' ' . $me['Second_Last_Name']); ?></h4>
        <small class="text-muted">@<?php echo htmlspecialchars($me['Username']); ?></small>
    </div>

    <!-- Datos en grid -->
    <div class="row g-3">

        <div class="col-6 col-md-4">
            <div class="p-2 rounded" style="background:#fff5f8;">
                <div style="font-size:0.75rem;color:#ff4f8b;font-weight:bold;">BIRTHDAY</div>
                <div><?php echo htmlspecialchars($me['Birthday']); ?></div>
            </div>
        </div>

        <div class="col-6 col-md-4">
            <div class="p-2 rounded" style="background:#fff5f8;">
                <div style="font-size:0.75rem;color:#ff4f8b;font-weight:bold;">GENDER</div>
                <div><?php echo htmlspecialchars($me['Gender']); ?></div>
            </div>
        </div>

        <div class="col-6 col-md-4">
            <div class="p-2 rounded" style="background:#fff5f8;">
                <div style="font-size:0.75rem;color:#ff4f8b;font-weight:bold;">STYLE</div>
                <div><?php echo htmlspecialchars($me['Style']); ?></div>
            </div>
        </div>

        <div class="col-6 col-md-4">
            <div class="p-2 rounded" style="background:#fff5f8;">
                <div style="font-size:0.75rem;color:#ff4f8b;font-weight:bold;">COLOR</div>
                <div class="d-flex align-items-center gap-2">
                    <span style="display:inline-block;width:18px;height:18px;border-radius:50%;background:<?php echo htmlspecialchars($me['Color']); ?>;border:1px solid #ddd;"></span>
                    <?php echo htmlspecialchars($me['Color']); ?>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-4">
            <div class="p-2 rounded" style="background:#fff5f8;">
                <div style="font-size:0.75rem;color:#ff4f8b;font-weight:bold;">DEFAULT LIST</div>
                <div><?php echo $me['Default_list'] ? '✅ Yes' : '❌ No'; ?></div>
            </div>
        </div>

        <div class="col-6 col-md-4">
            <div class="p-2 rounded" style="background:#fff5f8;">
                <div style="font-size:0.75rem;color:#ff4f8b;font-weight:bold;">DEFAULT TAG</div>
                <div><?php echo $me['Default_tag'] ? '✅ Yes' : '❌ No'; ?></div>
            </div>
        </div>

        <?php if($me['Motivational_phrase']): ?>
        <div class="col-12">
            <div class="p-2 rounded" style="background:#fff5f8;">
                <div style="font-size:0.75rem;color:#ff4f8b;font-weight:bold;">MOTIVATIONAL PHRASE</div>
                <div style="font-style:italic;">"<?php echo htmlspecialchars($me['Motivational_phrase']); ?>"</div>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>

<?php else: ?>
    <p class="text-muted text-center">No user data found.</p>
<?php endif; ?>
