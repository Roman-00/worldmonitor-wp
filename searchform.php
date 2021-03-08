<form class="search-form" role="search" id="searchform" action="<?php echo home_url( '/' ) ?>" >
    <div class="search-box">
        <div class="search-btn-btn">
            <i class="fas fa-search"></i>
        </div>
        <input class="search-input" type="text" placeholder="<?php _e('Search', 'worldmonitor')?>" value="<?php echo get_search_query() ?>" name="s" id="s" />
        <button id="searchsubmit" type="submit" class="search-btn">
            <i class="fas fa-search"></i>
        </button>
        <div class="cancel-btn">
            <i class="fas fa-times"></i>
        </div>
    </div>
</form>