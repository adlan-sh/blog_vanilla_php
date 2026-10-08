{extends file="layout.tpl"}
{block name=title}{$post->title}{/block}

{block name=content}
    <a href="/" class="back">← На главную</a>

    <article class="post-full">
        {if $post->image}
            <img src="{$post->image}" alt="{$post->title}" class="post-cover">
        {/if}
        <h1>{$post->title}</h1>
        <div class="meta">
            <span>Категории: {join($post->categories, ', ')}</span>
            <span>👁 {$post->views}</span>
            <span>📅 {$post->published_at|date_format:"d.m.Y H:i"}</span>
        </div>
        <p class="lead">{$post->description}</p>
        <div class="content">{$post->content nofilter}</div>
    </article>

    {if $post->similar}
        <section class="similar">
            <h2>Похожие статьи</h2>
            <div class="posts-grid">
                {foreach $post->similar as $post}
                    {include file="partials/post_card.tpl" post=$post}
                {/foreach}
            </div>
        </section>
    {/if}
{/block}