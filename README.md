CNC-Stats.com source code
========================

Project was founded on **26 May 2013** to collect and display Command&Conquer Tiberium Alliances players statistics.
In its short period of activity **more than 500GB** of data were collected and **70+k unique users** visited website with **more than 1M views**.

Due to high costs and lack of time to maintain it project founder closed website on **15 November 2014**.

Used technologies
========================

Project used many different technologies to keep it working.

All data were collected with use of bash and PHP scripts directly from game webservices.
Collected informations were saved in MySQL and MongoDB databases located on separated dedicated server.

Frontend were written in Symfony 2 (which code you can see in this repository) with help of memcached to reduce response times.

To enhance user experience there were also:
  * Google Charts
  * jQuery with custom plugins
  * statistics bot that posted rankings on in-game forums
  * Amazon SES based newsletter
  * in-game worlds data in CSV files to download
