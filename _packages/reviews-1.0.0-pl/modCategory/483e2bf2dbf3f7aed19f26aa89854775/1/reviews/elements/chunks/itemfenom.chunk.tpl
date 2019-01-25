<h3>{'reviews.review_title' | lexicon : [
    'idx'   => $idx,
    'total' => $total
]} {!empty($email) ? '<a href="mailto:' ~ $email ~ '" title="' ~ $name ~ '">' ~ $name ~ '</a>' : $name}</h3>
<p>{$rating}</p>
{$content}