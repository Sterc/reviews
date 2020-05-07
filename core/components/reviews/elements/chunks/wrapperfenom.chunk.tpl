<div class="row">
    <div class="col-12 col-md-4">
        <ul>
            {foreach $ratingStats as $stat}
                <li>{$stat.name}: <strong>{$stat.value}</strong></li>
            {/foreach}
        </ul>
        <p>{'reviews.average' | lexicon}: <strong>{$average}</strong></p>
    </div>
    <div class="col-12 col-md-8">
        <h2>{'reviews.title' | lexicon}</h2>
        {$output}
    </div>
</div>