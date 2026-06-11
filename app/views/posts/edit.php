<h1><?= htmlspecialchars($title) ?></h1>

<div class="form-card">

    <form method="POST" action="/posts/update/<?= $post['id'] ?>">

        <input
            type="hidden"
            name="_token"
            value="<?= htmlspecialchars($token) ?>">
            
        <div class="form-group">
            <label for="title">Title</label>

            <input
                id="title"
                type="text"
                name="title"
                value="<?= htmlspecialchars($old['title'] ?? '') ?>"
                class="<?= !empty($errors['title']) ? 'input-error' : '' ?>">
                
            <?php if (!empty($errors['title'])): ?>
                <div class="field-error">
                    <?= htmlspecialchars($errors['title']) ?>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="content">Content</label>

            <textarea
                id="content"
                name="content"
                class="<?= !empty($errors['content']) ? 'textarea-error' : '' ?>"><?= htmlspecialchars($old['content'] ?? '') ?></textarea>

            <?php if (!empty($errors['content'])): ?>
                <div class="field-error">
                    <?= htmlspecialchars($errors['content']) ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <button type="submit">
                Update Post
            </button>
        </div>

    </form>

</div>
        
