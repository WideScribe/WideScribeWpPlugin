<h3>
    <?php _e('WideScribe simulator', self::locale); ?>
</h3>
<ul class="WideScribeSimulator">
    <div data-role="fieldcontain">
        <label for="uniqueVisitorsPerWeek">Unique Visitors per week</label>
        <input type="range" name="uniqueVisitorsPerWeek" id="uniqueVisitorsPerWeek" 
               value="40000" 
               min="0" 
               max="200000" 
               step="5000"
               data-highlight="true"/>
        <div id="uniqueVisitorsPerWeekTxt"></div>
    </div>

    <div data-role="fieldcontain">
        <label for="registerConversionRate">Registration rate</label>
        <input type="range" name="registerConversionRate" id="registerConversionRate" 
               value="2" 
               min="0.000000000001"
               max="15" 
               step="0.5"
               data-highlight="true"/>
        <div id="registerConversionRateTxt"></div>
    </div>

    <div data-role="fieldcontain">
        <label for="topupConversionRate">Top up conversion rate</label>
        <input type="range" name="topupConversionRate" id="topupConversionRate" 
               value="2" 
               min="0.000000000001"
               max="15" 
               step="0.5"
               data-highlight="true"/>
        <div id="topupConversionRateTxt"></div>
    </div>

    <div data-role="fieldcontain">
        <label for="subscriptionConversionRate">Subscription conversion rate</label>
        <input type="range" name="subscriptionConversionRate" id="subscriptionConversionRate" 
               value="2" 
               min="0.000000000001"
               max="15" 
               step="0.5"
               data-highlight="true"/>
        <div id="subscriptionConversionRateTxt"></div>
    </div>

    <div data-role="fieldcontain">
        <label for="numberOfWeeks">Number of weeks to simulate</label>
        <input type="range" name="numberOfWeeks" id="numberOfWeeks" 
              value="2" 
               min="1"
               max="120" 
               step="1"
               data-highlight="true"/>
        <div id="numberOfWeeksTxt"></div>
    </div>

    <div data-role="fieldcontain">
        <label for="averageSubscriptionLength">Avg subscription length</label>
        <input type="range" name="numberOfWeeks" id="averageSubscriptionLength" 
               value="52" 
               min="0" 
               max="100" 
               step="1"
               data-highlight="true"/>
        <div id="averageSubscriptionLengthTxt"></div>
    </div>
    <div data-role="fieldcontain">
        Income from Pay Per Article
        <div class="calculatron" id="incomePPA"></div>
           Income from Subscriber Pay Per Article
        <div class="calculatron" id="incomePPAS"></div>
           Income from Subscriber KickBack
        <div class="calculatron" id="incomeKickback"></div>
        <hr>
        Registration penetration
        <div class="calculatron" id="registrationPenetration"></div> 
        WideScribe penetration
        <div class="calculatron" id="widescribePenetration"></div> 
        Total subscriptions gained
        <div class="calculatron" id="totalSubscGained"></div>
        Total subscription lost
        <div class="calculatron" id="totalSubscLost"></div>
        Active subscribers
        <div class="calculatron" id="totalSubscActive"></div>
        <button class="button" id="calculateBtn">Click to calucluate</button>
    </div>
</div>

</ul><!-- /widescribe_simulator -->