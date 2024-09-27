# ai-fe-exam
Archintel Developer Exam

## Specifications
- Develop a Writer/Editor Dashboard Site that has the ablity to create, edit, and publish an article related to the company. (screenshots are for UI referrence) 
- Should implement web responsive design
- Able to demonstrate API integration 

## Scoring
- Implemented functionalities
- HTML, CSS and Javascript skills
- Knowledge of API integration


## Database 
- Company
    -id
    -logo (url)
    -name (text)
    -Status [Active,Inactive]
- User 
    -id
    -Firstname (text)
    -Lastname (text)
    -Type [Writer,Editor]
    -Status [Active,Inactive]
- Article
    -id
    -Image (url)
    -Title (text)
    -Link (url)
    -Date (Date)
    -Content (text)
    -Status [For Edit, Published]
    -Writer (User FK)
    -Editor (User FK)
    -Company (Company FK)

## Forms & Fields

- User
    -firstname - text field (required)
    -lastname - text field (required)
    -type - select field (required)
    -status select field (required)
    

- Company:
    -logo - text field (required)
    -name - text field (required)
    -status - select field (required)

- Article
    -image - text field (required, must be a valid URL)
    -title - text field (required)
    -Link -  text field (required, must be a valid URL)
    -Date - date picker (required, must default to current date)
    -Content - text editor or WYSIWYG editor (required) 

## User access & actions
- Writer
    -Actions:
        -Create article (on click submit, must automatically set Article Status Field to "For Edit"), 
        -Edit an unpublish article (can only edit articles where Status is "For Edit") 
    -Pages:
        -Writer's Dashboard
            -must show 2 list of articles: For Edit (Status is "For Edit") and Published (Status is "Published")
            -Each item of For Edit Articles list must show a badge or status of the article.
            -Each item of both lists must display the following fields: Image, Title, Link, Date, Writer Name and Editor Name
        -All Media
            -show all articles being created in tabular display and must show the following columns: 
                actions (includes the edit action), image, title, link, writer, editor, status 
            -RESTRICT the writer to edit a published article 
     
- Editor 
    -Actions: 
        -Edit and Publish articles 
            -In Edit Article Form, there must be 2 buttons "Save" and "Publish", 
            where if clicked on Save, will update the record 
            else if clicked on Publish, will update the record and also sets the Status to "Publish"
        -Ability to manage users (create and updating)
        -Ability to mange companies (create and updating)
    -Pages: 
        -Editor's Dashboard
            -must show 2 list of articles: For Publish (Status is "For Edit") and Published (Status is "Published")
            -Each item of both lists must display the following fields: Image, Title, Link, Date, Writer Name and Editor Name
        -All Media
            -show all articles being created in tabular display and must show the following columns: 
            actions (includes the edit action), image, title, link, writer, editor, status 
            -RESTRICT the writer to edit a published article 

## Must Have Output
 1. Live link - url of your deployed output 
 2. Project files - your source code, it could be uploaded in github, bitbucket and must provide a readme file with instructions on how to run your output