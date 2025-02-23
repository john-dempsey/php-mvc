<?php
    $this->title = 'Credit Cards';
?>
<h1>Credit Cards</h1>
<a href="/cards/create" class="btn btn-sm btn-primary">Add Credit Card</a>
<?php if (count($cards) === 0) { ?>
    <p>No credit cards found.</p>
<?php } else { ?>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Number</th>
                <th>Expiration</th>
                <th>CVV</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cards as $card) { ?>
                <tr>
                    <td><?php echo $card->name ?></td>
                    <td><?php echo $card->number ?></td>
                    <td><?php echo $card->exp_month ?>/<?php echo $card->exp_year ?></td>
                    <td><?php echo $card->cvv ?></td>
                    <td>
                        <a href="/cards/edit?id=<?= $card->id ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                        <form action="/cards/delete" method="post" class="d-inline">
                            <input type="hidden" name="id" value="<?= $card->id ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>