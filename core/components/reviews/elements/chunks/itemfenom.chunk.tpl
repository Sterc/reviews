<h3>{'reviews.review_title' | lexicon : [
    'idx'   => $idx,
    'total' => $total
]} {!empty($email) ? '<a href="mailto:' ~ $email ~ '" title="' ~ $name ~ '">' ~ $name ~ '</a>' : $name}</h3>
<ul>
    {foreach $ratingTypes as $key => $stat}
        <li>{$stat.name}: <strong>{$ratings[$key]}</strong></li>
    {/foreach}
</ul>
<p>{$rating}</p>
{$content}