<div class="container">
    <div class="row">
        <div class="col-lg-7 col-lg-offset-1">
            {if isset($error)}
                <div class="alert alert-warning">
                    {$error}
                </div>
            {/if}

            {if isset($success)}
                <div class="alert alert-success">
                    {$success}
                </div>
            {/if}
            <h2 style="margin-top: 0">{$firstpost['thread_title']}</h2>
            <hr />
            <div class="postbit">
                <!-- BEGIN AVATAR -->
                {if $firstpost['avatar'] == null}
                    <img src="https://en.gravatar.com/images/gravatars/no_gravatar.gif" class="avatar" />
                {else}
                    <img src="{$firstpost['avatar']}" class="avatar" />
                {/if}

                <span class="pull-left">
                    <a href="#">{$firstpost['username']}</a>
                    <br />
                    0 messages
                </span>

                <span class="pull-right">
                    {timeAgo($firstpost['date'])}
                </span>
                <!-- END AVATAR -->
            </div>
            <div style="clear:both;"></div>

            <div class="row">
                <div class="col-lg-12">
                    <br />
                    {purify($firstpost['thread_content'])}
                </div>
            </div>
            <hr />

            {if isset($noreplies)}
                <div class="alert alert-warning">
                    There are no replies to this thread yet
                </div>
            {/if}

            {foreach $subposts as $post}
                <div class="postbit">
                    {if $post['avatar'] == null}
                        <img src="https://en.gravatar.com/images/gravatars/no_gravatar.gif" class="avatar" />
                    {else}
                        <img src="{$post['avatar']}" class="avatar" />
                    {/if}

                    <span class="pull-left">
                        <a href="#">{$post['username']}</a>
                        <br />
                        0 messages
                    </span>

                    <span class="pull-right">
                        {timeAgo($post['date'])}
                    </span>
                </div>
                <div style="clear:both"></div>

                <div class="row">
                    <div class="col-lg-12">
                        <br />
                        {purify($post['reply_content'])}
                    </div>
                </div>
                <hr />
            {/foreach}   

            {if isset($user)}
                <form method="POST">
                    <div class="form-group">
                        <textarea name="message" class="form-control" placeholder="Add a message to this thread"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success" name="addpost">
                            Add Message
                        </button>
                    </div>
                </form>
            {/if}
        </div>

        <div class="col-lg-3">

        </div>
    </div>
</div>