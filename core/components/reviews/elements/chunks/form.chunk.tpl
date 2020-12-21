<form action="[[~[[*id]]]]" method="post">
    <h2>Your Information</h2>
    <div class="form-group">
        <label class="sr-only" for="name">[[%reviews.label_review_name? &namespace=`reviews`]]</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="[[%reviews.label_review_name? &namespace=`reviews`]]" value="[[!+fi.name]]" required>
        [[!+fi.error.name]]
    </div>
    <div class="form-group">
        <label class="sr-only" for="email">[[%reviews.label_review_email? &namespace=`reviews`]]</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="[[%reviews.label_review_email? &namespace=`reviews`]]" value="[[!+fi.email]]" required>
        [[!+fi.error.email]]
    </div>
    [[!ReviewGroup?
    &type=`default`
    &value=`[[!+fi.rating_default]]`
    &error=`[[!+fi.error.rating_default]]`
    &required=`1`
    ]]
    <div class="form-group">
        <label class="sr-only" for="content">[[%reviews.label_review_content? &namespace=`reviews`]]</label>
        <textarea class="form-control" id="content" name="content" placeholder="[[%reviews.label_review_content? &namespace=`reviews`]]">[[!+fi.content]]</textarea>
        [[!+fi.error.content]]
    </div>
    <div class="form-group">
        <button type="submit" id="submit" class="btn btn-primary">[[%submit? &namespace=`core`]]</button>
    </div>
</form>
