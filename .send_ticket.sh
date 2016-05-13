#!/bin/bash
curl -i --user $jira_user:$jira_pass \
-H "Content-Type: application/json" \
-H "Accept: application/json" \
-X POST -d '{"fields": {"project":{ "key": "PM"}, "summary": "Travis Build Error: '"$TRAVIS_BRANCH"'", "description": "The build process of commit: '"$TRAVIS_COMMIT"' was not successful. Please visit https://travis-ci.org/MathJunkie/MathJunkie_Laravel/builds/'"$TRAVIS_BUILD_ID"' This information was automatically created. Please add further instructions.",  "issuetype": {"name": "Bug" } } }' jira.it.dh-karlsruhe.de:8080/rest/api/2/issue/