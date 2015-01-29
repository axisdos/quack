<div class="row">
<div class="col-lg-12">
{if isset($postadded)}
	<div class="alert alert-success">
		Your post has been added. Click <a href="thread/{$thread}">here</a> to return to the thread.
	</div>
{/if}
{if isset($error)}
	<div class="alert alert-warning">
		{$error}
	</div>
{/if}

<form method="POST">
    <div class="form-group">
        <textarea name="content" class="form-control" placeholder="Add a message to this thread"></textarea>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-success" name="addpost">
            Add Message
        </button>
    </div>
</form>
</div>
</div>