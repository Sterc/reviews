<div class="row">
    <div class="col-12 col-md-4">
        <ul>
            <li>5 {'reviews.rating_5' | lexicon}: {$stats[5]}</li>
            <li>4 {'reviews.rating_4' | lexicon}: {$stats[4]}</li>
            <li>3 {'reviews.rating_3' | lexicon}: {$stats[3]}</li>
            <li>2 {'reviews.rating_2' | lexicon}: {$stats[2]}</li>
            <li>1 {'reviews.rating_1' | lexicon}: {$stats[1]}</li>
        </ul>
    </div>
    <div class="col-12 col-md-8">
        <h2>{'reviews.title' | lexicon}</h2>
        <p>{$rating}</p>
        {$output}
    </div>
</div>