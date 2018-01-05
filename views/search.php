<div class="row">
    <div class="col-xs-12">
        <form action="/home/search" method="post">
            <input type="hidden" name="_token" value="<?= csrf_token() ?>" />

            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <div class="form-group">
                        <label for="age">Age Range</label>
                        <select class="form-control" name="age" id="age">
                            <option value="">-/-</option>
                            <?php foreach (config('AGE_RANGES') as $age_range) { ?>
                                <option value="<?= $age_range ?>" <?= $search['age'] == $age_range ? 'selected=selected' : '' ?>><?= $age_range ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-4">
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" name="gender" id="gender">
                            <option value="">-/-</option>
                            <option value="0" <?= $search['gender'] === '0' ? 'selected=selected' : '' ?>>Female</option>
                            <option value="1" <?= $search['gender'] === '1' ? 'selected=selected' : '' ?>>Male</option>
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-4">
                    <div class="form-group">
                        <label for="city">City</label>
                        <select class="form-control" name="city" id="city">
                            <option value="">-/-</option>
                            <?php foreach (config('CITIES') as $city) { ?>
                                <option value="<?= $city ?>" <?= $search['city'] == $city ? 'selected=selected' : '' ?>><?= ucfirst($city) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-offset-4 col-sm-4">
                    <button type="submit" class="btn btn-block btn-primary">Match !</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <?php foreach ($results as $result) { ?>
        <div class="col-xs-12">
            <h4><?= "$result->firstname $result->lastname" ?></h4>
        </div>
    <?php } ?>
</div>
