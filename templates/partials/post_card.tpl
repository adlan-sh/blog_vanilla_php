<article class="post-card">
    {if $post->image}
        <img src="{$post->image}" alt="{$post->title}">
    {/if}
    <h3><a href="/post?id={$post->id}">{$post->title}</a></h3>
    <p>{$post->description}</p>
    <div class="meta">
        <span>Просмотры: {$post->views}</span>
        <span>Дата публикаций: {$post->published_at|date_format:"d.m.Y"}</span>
    </div>
</article>