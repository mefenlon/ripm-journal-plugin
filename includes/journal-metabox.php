<?php

//Define the meta box
if ( ! function_exists( 'ripm_jcpt_journal_meta_box_add' ) ) {

    add_action('add_meta_boxes', 'ripm_jcpt_journal_meta_box_add');
    function ripm_jcpt_journal_meta_box_add()
    {
        add_meta_box('ripm-journal-meta-box-id', 'Journal Information', 'ripm_jcpt_journal_meta_box', 'ripm_journal', 'side', 'high');
    }
}

//Define display elements for meta box fields
if ( ! function_exists( 'ripm_jcpt_journal_meta_box' ) ) {

    function ripm_jcpt_journal_meta_box()
    {
        global $post;

        $sort_title = get_post_meta($post->ID, 'ripm_journal_meta_box_sort_title', true);
        $abbreviation = get_post_meta($post->ID, 'ripm_journal_meta_box_abbreviation', true);
        $start_year = get_post_meta($post->ID, 'ripm_journal_meta_box_start_year', true);
        $display_date = get_post_meta($post->ID, 'ripm_journal_meta_box_display_date', true);
        $display_locations_and_dates = get_post_meta($post->ID, 'ripm_journal_meta_box_display_locations_and_dates', true);
        $periodicity = get_post_meta($post->ID, 'ripm_journal_meta_box_periodicity', true);

        //nonce field used when saving.
        wp_nonce_field('ripm_journal_meta_box_nonce', 'meta_box_nonce');

        ?>
        <fieldset>
            <div>
                <label for="ripm_journal_meta_box_sort_title">Sort Title</label>
                <input type="text" name="ripm_journal_meta_box_sort_title" id="ripm_journal_meta_box_sort_title"
                       value="<?php echo $sort_title; ?>"/>
            </div>
        </fieldset>

        <fieldset>
            <div>
                <label for="ripm_journal_meta_box_abbreviation">Abbreviation</label>
                <input type="text" name="ripm_journal_meta_box_abbreviation" id="ripm_journal_meta_box_abbreviation"
                       value="<?php echo $abbreviation; ?>"/>
            </div>
        </fieldset>

        <fieldset>
            <div>
                <label for="ripm_journal_meta_box_start_year">Start Year</label>
                <input type="text" name="ripm_journal_meta_box_start_year" id="ripm_journal_meta_box_start_year"
                       value="<?php echo $start_year; ?>"/>
            </div>
        </fieldset>

        <fieldset>
            <div>
                <label for="ripm_journal_meta_box_display_date">Display Date</label>
                <input type="text" name="ripm_journal_meta_box_display_date" id="ripm_journal_meta_box_display_date"
                       value="<?php echo $display_date; ?>"/>
            </div>
        </fieldset>

        <fieldset>
            <div>
                <label for="ripm_journal_meta_box_periodicity">Periodicity</label>
                <input type="text" name="ripm_journal_meta_box_periodicity" id="ripm_journal_meta_box_periodicity"
                       value="<?php echo $periodicity; ?>"/>
            </div>
        </fieldset>

        <fieldset>
            <div>
                <label for="ripm_journal_meta_box_display_locations_and_dates">Display Locations and Date</label>

                <textarea id="ripm_journal_meta_box_display_locations_and_dates" name="ripm_journal_meta_box_display_locations_and_dates" rows="2" ><?php echo $display_locations_and_dates; ?></textarea>
                <p class="howto" id="new-ripm_journal_meta_box_display_locations_and_dates-desc">
                    Only necessary when there is more than one location and date.<br/>
                    This will appear after the journal title.<br/>
                    Ex: Jazz Quarterly
                    (<strong>Kingsville, Texas, 1942-43; Chicago, Illinois, 1944</strong>)<br/>
                    If left empty, the field is auto-generated using city and display date.

                </p>
            </div>
        </fieldset>

        <?php
    }
}
//Save input from meta box
if ( ! function_exists( 'ripm_jcpt_journal_meta_box_save' ) ) {

    add_action('save_post', 'ripm_jcpt_journal_meta_box_save');

    function ripm_jcpt_journal_meta_box_save($post_id)
    {
        global $post;

        // Bail if we're doing an auto save
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

        // if our nonce isn't there, or we can't verify it, bail
        if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], 'ripm_journal_meta_box_nonce')) return;

        // if our current user can't edit this post, bail
        if (!current_user_can('edit_post')) return;

        // now we can actually save the data
        $allowed = array(
            'a' => array( // on allow a tags
                'href' => array() // and those anchors can only have href attribute
            )
        );


        //Check that data is set and clean before saving it
        if (isset($_POST['ripm_journal_meta_box_sort_title']))
            update_post_meta($post_id, 'ripm_journal_meta_box_sort_title', wp_kses($_POST['ripm_journal_meta_box_sort_title'], $allowed));
        if (isset($_POST['ripm_journal_meta_box_abbreviation']))
            update_post_meta($post_id, 'ripm_journal_meta_box_abbreviation', wp_kses($_POST['ripm_journal_meta_box_abbreviation'], $allowed));
        if (isset($_POST['ripm_journal_meta_box_start_year']))
            update_post_meta($post_id, 'ripm_journal_meta_box_start_year', wp_kses($_POST['ripm_journal_meta_box_start_year'], $allowed));
        if (isset($_POST['ripm_journal_meta_box_display_date']))
            update_post_meta($post_id, 'ripm_journal_meta_box_display_date', wp_kses($_POST['ripm_journal_meta_box_display_date'], $allowed));
        if (isset($_POST['ripm_journal_meta_box_display_locations_and_dates']))
            update_post_meta($post_id, 'ripm_journal_meta_box_display_locations_and_dates', wp_kses($_POST['ripm_journal_meta_box_display_locations_and_dates'], $allowed));
        if (isset($_POST['ripm_journal_meta_box_periodicity']))
            update_post_meta($post_id, 'ripm_journal_meta_box_periodicity', wp_kses($_POST['ripm_journal_meta_box_periodicity'], $allowed));


    }
}
