<?php
    $this->title = 'Create New Credit Card';
?>
<h1>Create New Credit Card</h1>

<form action="/cards/store" method="post">
    <div class="row mb-4">
        <div class="col-6">
            <div class="form-outline">
                <label class="form-label">Name on card</label>
                <input type="text" name="name" class="form-control" value="<?= old("name") ?>" />
                <span class="error"><?= error("name") ?></span>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-6">
            <div class="form-outline">
                <label class="form-label">Credit card number</label>
                <input type="text" name="number" class="form-control" value="<?= old("number") ?>" />
                <span class="error"><?= error("number") ?></span>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-2">
            <div class="form-outline">
                <label class="form-label">Expiry month</label>
                <select name="exp_month" class="form-control">
                    <option value="">Month</option>
                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                        <option value="<?= $i ?>" <?= chosen("exp_month", $i) ? "selected" : "" ?>><?= $i ?></option>
                    <?php } ?>
                </select>
                <span class="error"><?= error("exp_month") ?></span>
            </div>
        </div>
        <div class="col-2">
            <div class="form-outline">
                <label class="form-label">Expiry year</label>
                <select name="exp_year" class="form-control">
                    <option value="">Year</option>
                    <?php for ($i = date('Y'); $i <= date('Y') + 5; $i++) { ?>
                        <option value="<?= $i ?>" <?= chosen("exp_year", $i) ? "selected" : "" ?>><?= $i ?></option>
                    <?php } ?>
                </select>
                <span class="error"><?= error("exp_year") ?></span>
            </div>
        </div>
        <div class="col-2">
            <div class="form-outline">
                <label class="form-label">CVV</label>
                <input type="text" name="cvv" class="form-control" value="<?= old("cvv") ?>" />
                <span class="error"><?= error("cvv") ?></span>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
clear_form_data();
?>