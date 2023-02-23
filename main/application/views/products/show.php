<?php $this->load->view('partials/header'); ?>

    <h1><?= $product['name'] ?> ($<?= $product['price'] ?>)</h1>
    <p>Added since <?= $product['created_at'] ?></p>
    <p>Product ID: #<?= $product['id'] ?></p>
    <p>Description: <?= $product['description'] ?></p>
    <p>Total sold: <?= $product['sold'] ?></p>
    <p>Number of available stock: <?= $product['stock'] ?></p>

    <h2>Leave A Review</h2>
    <!-- post a review -->
    <form action="/products/post_review" method="post">
        <input type="hidden" name="product_id" value=<?= $product['id'] ?>>
        <textarea class="text-block" name="product_review" placeholder="Post a review"></textarea>
        <input type="submit" value="Post">
    </form>
<?php foreach($reviews as $review) { ?>
    <div class="review">
        <span class="author"><?= $review['first_name'] ?> <?= $review['last_name'] ?> wrote:</span>
        <span class="date"><?= $review['review_date'] ?></span>
        <p class="content"><?= $review['review'] ?></p>
        <form action="/products/post_comment" method="post">
            <input type="hidden" name="product_id" value=<?= $product['id'] ?>>
            <input type="hidden" name="review_id" value=<?= $review['review_id'] ?>>
            <textarea class="comment-block" name="comment" placeholder="Post a comment"></textarea>
            <input class="post" type="submit" value="Post">
        </form>
<?php   foreach($comments as $comment) {
            if (isset($comment['comment']) && $comment['review_id'] === $review['review_id']) { ?>
        <div class="comment">
            <span class="author"><?= $comment['first_name'] ?> <?= $comment['last_name'] ?> wrote:</span>
            <span class="date"><?= $comment['comment_date'] ?></span>
            <p class="content"><?= $comment['comment'] ?></p>
        </div>
<?php       }
        } ?>
    </div>    
<?php } ?>

<?php $this->load->view('partials/footer'); ?>
