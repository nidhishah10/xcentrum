<form id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <div class="form-group">
                              <i class="icon-search"></i>
                              <input type="text" placeholder="Search here..." class="textbox search-field" name="s" value="<?php echo get_search_query(); ?>">
                              <input type="submit" value="Search">
                            </div>
                          </form>