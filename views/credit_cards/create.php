<?php
    $this->title = 'Create New Credit Card';
?>
<h1>Create New Credit Card</h1>

<form action="/cards/store" method="post">
    <div class="row mb-4">
        <div class="col-6">
            <div class="form-outline">
                <label class="form-label">Name on card</label>
                <input type="text" name="name" class="form-control" />
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-6">
            <div class="form-outline">
                <label class="form-label">Credit card number</label>
                <input type="text" name="number" class="form-control" />
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
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-2">
            <div class="form-outline">
                <label class="form-label">Expiry year</label>
                <select name="exp_year" class="form-control">
                    <option value="">Year</option>
                    <?php for ($i = date('Y'); $i <= date('Y') + 5; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-2">
            <div class="form-outline">
                <label class="form-label">CVV</label>
                <input type="text" name="cvv" class="form-control" />
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>