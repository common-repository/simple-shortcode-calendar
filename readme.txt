=== Simple Shortcode Calendar ===
Contributors: kamontander, davidwalsh83
Donate link:
Tags: shortcode, calendar, dates, highlight
Requires at least: 2.5
Tested up to: 3.7
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
Lets you create a monthly calendar by entering a shortcode. Calendar is output as an HTML table. You can also highlight certain dates.
 
== Description ==
Simple Shortcode Calendar lets you add an HTML-table-based monthly calendar to your posts and pages by entering a shortcode.

**Features**

* Defaults to current month.
* Choose any year+month combination.
* Choose the first day of the week (Monday, Sunday or Saturday).
* Enter custom names for months and days (for localization purposes).
* Highlight important dates.

This plugin is based on a [tutorial for building a calendar using PHP, XHTML, and CSS](http://davidwalsh.name/php-calendar) by David Walsh.
 
== Installation ==

1. Upload `simple-shortcode-calendar.zip` through Plugins->Add New, or extract and upload the directory `simple-shortcode-calendar` to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Place the shortcode in a post or a page.

== Frequently Asked Questions ==
 
= How do I add the calendar to my post/page? =
 
To insert the current month, simply enter the following shortcode where you want the calendar to appear:

`
[calendar]
`

Please note that this calendar will change as months go by.
 
= How do I choose a custom month? =

Simply include values for `year` and `month` parameters, e.g.,
 
`
[calendar year="1945" month="5"]
`

This will output the calendar for May 1945. Years have to be entered using four digits, i.e. typing just "45" won't work. The allowed values for months are numbers from 1 to 12 (without leading zeros).

= How do I get localized names for months and days? =

Since PHP's `setlocale()` function isn't always a reliable method with self-hosted WordPress sites, localized names have to be manually entered for each instance of the shortcode. For example, if you wish to output a calendar in Spanish, you'd have to enter the following:

`
[calendar day_names="Dom,Lun,Mar,Mié,Jeu,Vie,Sáb" month_names="Enero,Febrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Septiembre,Octubre,Noviembre,Diciembre"]
`

Please note that you have to fill in the names for all seven days if you choose to use the `day_names` parameter. Analogously, the `month_names` parameter requires all twelwe month names to work, regardless of the fact that you might want to display only one of them. Values for both parameters have to be entered in a comma-separated sequence, without spaces.

= Can I change the first day of the week in my calendar? =

Yes, you can choose between Monday (default), Sunday or Saturday. Just use the parameter `week_start`. The allowed values are: "Sun", "Sunday", "Sat", "Saturday", case insensitive.

= How do I highlight certain dates? =

This can be done by using the `dates` parameter, like this:

`
[calendar year="1945" month="5" dates="8,9"]
`

This will output the calendar for May 1945, with 8th and 9th day highlighted. Values for `dates` parameter have to be entered in a comma-separated sequence, without spaces or leading zeros.

Please note that the dates in the calendar will only be highlighted if you add an appropriate CSS rule to your theme's stylesheet, which brings us to the next question.

= My calendar looks plain, are there any display presets to choose from? =

No. The shortcode outputs an unformatted table without any styles applied. To minimize the HTML output and maximize the control over the appearance we've decided to keep it simple. This is how the source of the calendar from the last example looks like:

`
<table cellpadding="0" cellspacing="0" class="calendar">
    <tbody>
        <tr>
            <td colspan="7">May 1945.</td>
        </tr>
        <tr>
            <th>Mon</th>
            <th>Tue</th>
            <th>Wed</th>
            <th>Thu</th>
            <th>Fri</th>
            <th>Sat</th>
            <th>Sun</th>
        </tr>
        <tr>
            <td> </td>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
        </tr>
        <tr>
            <td>7</td>
            <td class="highlight">8</td>
            <td class="highlight">9</td>
            <td>10</td>
            <td>11</td>
            <td>12</td>
            <td>13</td>
        </tr>
        <tr>
            <td>14</td>
            <td>15</td>
            <td>16</td>
            <td>17</td>
            <td>18</td>
            <td>19</td>
            <td>20</td>
        </tr>
        <tr>
            <td>21</td>
            <td>22</td>
            <td>23</td>
            <td>24</td>
            <td>25</td>
            <td>26</td>
            <td>27</td>
        </tr>
        <tr>
            <td>28</td>
            <td>29</td>
            <td>30</td>
            <td>31</td>
            <td> </td>
            <td> </td>
            <td> </td>
        </tr>
    </tbody>
</table>
`
 
== Screenshots ==

Nothing to display, really.

== Changelog ==
 
= 1.0 =
* Initial release.
 
== Upgrade Notice ==
 
= 1.0 =
Initial release.