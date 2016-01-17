<!DOCTYPE html>
<html>
<head>
    <title>Daily Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/base.css">
</head>
<body>
    <div>
        <h1>Daily dashboard</h1>
        <p>private dashboard for daily work</p>

        <h2>Today events</h2>
        <p><strong>{$today}</strong></p>
        {foreach from=$todayEvents item=te}
            <p>{$te}</p>
        {foreachelse}
            <p>No events.</p>
        {/foreach}

        <h2>This Week events</h2>
        <p>From: <strong>{$thisWeek.from}</strong> to <strong>{$thisWeek.to}</strong></p>
        {foreach from=$thisWeekEvents item=twe}
            <p>{$twe}</p>
        {/foreach}

        <h2>Next Week events</h2>
        <p>From: <strong>{$nextWeek.from}</strong> to <strong>{$nextWeek.to}</strong></p>
        {foreach from=$nextWeekEvents item=nwe}
            <p>{$nwe}</p>
        {/foreach}

        <h2>Last Week events</h2>
        <p>From: <strong>{$lastWeek.from}</strong> to <strong>{$lastWeek.to}</strong></p>
        {foreach from=$lastWeekEvents item=lwe}
            <p>{$lwe}</p>
        {/foreach}
    </div>
</body>
</html>