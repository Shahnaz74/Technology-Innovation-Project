# API

## templates/getTemplates.php
GET Display all templates in the database with their data, including name, icon and data of the fields related to them.

### PARAMS

#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.

#### RETURN
Returns a JSON object of templates, contains all data, including name, icon and data of the fields related to templates.

E.g
```JSON
{
    "templates":[
        {
	        "template_id": "1",
	        "template_name": "Advertisement Journal",
	        "template_icon": null,
	        "fields": [
	        	{
	        		"title": "Contributor",
	        		"name": "contributor",
	        		"placeholder":"Enter the name of the contributor",
	        		"is_required": 0
	    		},
	    		{
	    			"title": "Coverage",
	    			"name": "coverage",
	    			"placeholder":"Enter the spatial or temporal topic of the resource",
	    			"is_required": 0
	    		}
	        ]
        },
        {
        	"template_id": "2",
	        "template_name": "Advertisement Newspaper",
	        "template_icon": null,
	        "fields": [
	        	{
	        		"title": "Contributor",
	        		"name": "contributor",
	        		"placeholder":"Enter the name of the contributor",
	        		"is_required": 0
	    		},
	    		{
	    			"title": "Creator",
	    			"name": "creator",
	    			"placeholder":"Enter the name of the creator",
	    			"is_required": 1
	    		},
	    		{
	    			"title": "Date",
	    			"name": "date",
	    			"placeholder":"Enter the date associated with the resource",
	    			"is_required": 1
	    		}
	        ]
        }
    ]
}
```


## templates/getTemplatesById.php
GET Display templates in the database with their data, including name, icon and data of the fields related to it based on template_name.

### PARAMS template_name

#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.

#### RETURN
Returns a JSON object of a template, contains all data, including name, icon and data of the fields related to that template based on a provided template_name.

E.g
```JSON
{
    "template":
        {
	        "template_id": "1",
	        "template_name": "Advertisement Journal",
	        "template_icon": null,
	        "fields": [
	        	{
	        		"title": "Contributor",
	        		"name": "contributor",
	        		"placeholder":"Enter the name of the contributor",
	        		"is_required": 0
	    		},
	    		{
	    			"title": "Coverage",
	    			"name": "coverage",
	    			"placeholder":"Enter the spatial or temporal topic of the resource",
	    			"is_required": 1
	    		},
	    		{
	    			"title": "Title",
	    			"name": "title",
	    			"placeholder":"Enter a name given to the resource",
	    			"is_required": 0
	    		}
	        ]
        }
}
```


## templates/editTemplates.php
### PUT based on the template_name, edit a template data, including name, icon and fields related to the template. The added fields are taken from field table. Relate the field to the template through creating new rows in fields_in_template table

#### PARAMS 
template_name

#### EXPECTED_DATA
 
e.g
```JSON
{
	"template_name": "Advertisement Newspaper",
	"template_icon": null,
	"fields": [
		{
			"name": "contributor",
			"is_required": 0
		},
		{
			"name": "creator",
			"is_required": 1
		},
		{
			"name": "date",
			"is_required": 1
		}
	]
}
```

#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.

#### RETURNS
return a message notify that the data has been editted, come with new data in a JSON format
E.g
```JSON
{
	"message": "Template has been updated",
	"data":
		{
			"template_name": "Advertisement Newspaper",
			"template_icon": null,
			"fields": [
				{
					"name": "contributor",
					"is_required": 0
				},
				{
					"name": "creator",
					"is_required": 1
				},
				{
					"name": "date",
					"is_required": 1
				},
				{
					"name": "publisher",
					"is_required": 0
				}
			]
		}
}
```


## templates/createTemplates.php
### POST Create a template data, including name, icon and fields related to templates based on the template_name. fields are taken from existing data of field table

#### EXPECTED_DATA
 
e.g
```JSON
{
	"template_name": "Historical article",
	"template_icon": null,
	"fields": [
		{
			"name": "contributor",
			"is_required": 0
		},
		{
			"name": "creator",
			"is_required": 1
		},
		{
			"name": "date",
			"is_required": 1
		},
		{
			"name": "publisher",
			"is_required": 0
		}
	]
}
```
#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.

#### RETURNS
return a message notify that the data has been created, come with new data in a JSON format
E.g
```JSON
{
	"message": "Template has been created successfully",
	"data":
		{
			"template_name": "Historical article",
			"template_icon": null,
			"fields": [
				{
					"name": "contributor",
					"is_required": 0
				},
				{
					"name": "creator",
					"is_required": 1
				},
				{
					"name": "date",
					"is_required": 1
				},
				{
					"name": "publisher",
					"is_required": 0
				}
			]
		}
}
```

## templates/removeTemplates.php
### DELETE remove a template based on the template_name and remove all fields_in_template table data related to that template 
### PARAMS template_name

#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.

#### RETURNS
return a message notify that the template has been deleted



## fields/getFields.php
### GET receive a template_name and return the data of fields which are related to the template
#### PARAMS template_name
#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.
#### RETURNS
return a JSON object display data of fields related to the template
E.g
```JSON
{ 
	"fields":[
		{
		"name": "contributor",
		"title": "Contributor",
		"placeholder": "Enter the name of the contributor",
		"is_required": 0
		},
		{
		"name": "creator",
		"title": "Creator",
		"placeholder": "Enter the name of the creator",
		"is_required": 1
		},
		{
		"name": "date",
		"title": "Date",
		"placeholder": "Enter the date associated with the resource",
		"is_required": 1
		},
		{
		"name": "publisher",
		"title": "Publisher",
		"placeholder": "Enter the name of the publisher",
		"is_required": 0
		}
	]
}
```


## fields/addNewFields.php
### POST receive a template_name of a existing template and a name of a existing field in field table, create a new row in fields_in_template table to make the field related to the template
#### PARAMS template_name, field_name, is_required
#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.
#### RETURN
return a message notify the field is added succesfuly come with data of the template after adding in a JSON format
E.g
```JSON
{
	"message":"The field has been added successfully",
	"data": 
	{
		"template_name":"Sale Record",
		"template_icon": null,
		"fields":[
			{
				"name": "contributor",
				"is_required": 1
			}
		]
	}
}
```

## fields/getFieldsToAdd.php
### GET receive a template_name of a existing template, response all the fields in field table that are not related to the provided template
#### PARAMS template_name
#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.
#### RETURN
return all the fields in field table which are not related to the provided template
E.g
```JSON
{
	"fields":[
		{
		"name": "contributor",
		"title": "Contributor",
		"placeholder": "Enter the name of the contributor"
		},
		{
		"name": "creator",
		"title": "Creator",
		"placeholder": "Enter the name of the creator"
		},
		{
		"name": "date",
		"title": "Date",
		"placeholder": "Enter the date associated with the resource"
		},
		{
		"name": "publisher",
		"title": "Publisher",
		"placeholder": "Enter the name of the publisher"
		}
	]
}
```




## fields/removeFields.php
### DELETE receive a existing template_name in template table and a name of a existing field in field table, remove a row in fields_in_template table to detach the field from the template
#### PARAMS template_name, field_name
#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.
#### RETURN
return a message to notify that the field is detached from the provided template 



## uploads/getUploads.php
### GET Display all uploads data.

#### PARAMS 

#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.

#### RETURN
returns all data approved uploads including template_name and keywords related to them through keyword_upload table
E.g
```JSON
{
	"uploads": [
		{
			"upload_id": "1",
			"file_name": "sample_file1",
			"contributor":null,
			"coverage":"Coverage1",
			"creator": null,
			"date":null,
			"description":null,
			"format":"PDF",
			"identifier":"1234",
			"language":"Mandarin",
			"publisher":"Mandarin Publishing",
			"relation":null,
			"rights":null,
			"source":null,
			"title":"Sample File",
			"first_name":"Creator1",
			"last_name":"Creator1",
			"email":"creator1@example.com",
			"upload_status":"1",
			"template_name":"Advertisement Journal",
			"subject": ["keyword1","keyword6"]
		},
		{
			"upload_id": "2",
			"file_name": "sample_file2",
			"contributor":null,
			"coverage":null,
			"creator": null,
			"date":null,
			"description":null,
			"format":"PDF",
			"identifier":"12345",
			"language":"English",
			"publisher":"Random Publishing",
			"relation":null,
			"rights":"All rights Reserved",
			"source":null,
			"title":"Sample File",
			"first_name":"Creator2",
			"last_name":"Creator2",
			"email":"creator2@example.com",
			"upload_status":"2",
			"template_name":"Advertisement Newspaper",
			"subject": ["keyword3","keyword4"]
		},
		{
			"upload_id": "3",
			"file_name": "sample_file3",
			"contributor":"contributor3",
			"coverage":null,
			"creator": null,
			"date":null,
			"description":null,
			"format":"PDF",
			"identifier":"123456",
			"language":"English",
			"publisher":"Random Publishing",
			"relation":null,
			"rights":"All rights Reserved",
			"source":null,
			"title":"Sample File",
			"first_name":"Creator3",
			"last_name":"Creator3",
			"email":"creator3@example.com",
			"upload_status":"2",
			"template_name":"Article Journal",
			"subject": ["keyword3","keyword5"]
		}
	]
}
```

## uploads/getUploads.php
### GET Display user upload data based on upload_id.

#### PARAMS upload_id

#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.

#### RETURN
returns data of a row which contain provided upload_id, including keywords related to it
E.g
```JSON
{
	"uploads": [
		{
			"upload_id": "3",
			"file_name": "sample_file3",
			"contributor":"contributor3",
			"coverage":null,
			"creator": null,
			"date":null,
			"description":null,
			"format":"PDF",
			"identifier":"123456",
			"language":"English",
			"publisher":"Random Publishing",
			"relation":null,
			"rights":"All rights Reserved",
			"source":null,
			"title":"Sample File",
			"first_name":"Creator3",
			"last_name":"Creator3",
			"email":"creator3@example.com",
			"upload_status":"2",
			"template_name":"Article Journal",
			"subject": ["keyword3","keyword5"]
		}
	]
}
```


## uploads/createUpload.php
### POST Create new data of upload. The upload created will be in suitable status and related to keywords in subject data which is existing in keyword table through keyword_upload tables

#### EXPECTED DATA
all data about the new upload based on JSON format
E.g
```JSON
{
	"file_name": "sample_file4",
	"file":"path/to/sample_file.pdf",
	"contributor":"contributor4",
	"coverage":null,
	"creator": "creator4",
	"date":"12-01-2022",
	"description":"description for the article journal sample_file4",
	"format":"PDF",
	"identifier":"123456",
	"language":"English",
	"publisher":"Random Publishing",
	"relation":null,
	"rights":"All rights Reserved",
	"source":null,
	"title":"Sample File",
	"first_name":"Creator4",
	"last_name":"Creator4",
	"email":"creator4@example.com",
	"upload_status":"1",
	"template_name":"Article Journal",
	"subject": ["keyword2","keyword6"]
}
```

#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.

#### RETURN
returns a message notify the upload is created successfully with all data about the upload including keywords related to them through keyword_upload table
E.g

```JSON
{
	"massge":"upload has been created successfully",
	"data":
	{
		"upload_id":"4",
		"file_name": "sample_file4",
		"file":"path/to/sample_file.pdf",
		"contributor":"contributor4",
		"coverage":null,
		"creator": "creator4",
		"date":"12-01-2022",
		"description":"description for the article journal sample_file4",
		"format":"PDF",
		"identifier":"123456",
		"language":"English",
		"publisher":"Random Publishing",
		"relation":null,
		"rights":"All rights Reserved",
		"source":null,
		"title":"Sample File",
		"first_name":"Creator4",
		"last_name":"Creator4",
		"email":"creator4@example.com",
		"upload_status":"1",
		"template_name":"Article Journal",
		"subject": ["keyword2","keyword6"]
	}
}
```

## uploads/removeUpload.php
### DELETE Remove an upload based on the upload_id and remove keywords related to that upload

#### PARAMS upload_id

#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.

#### RETURN
returns a message notify the upload is deleted successfully 


## uploads/editUpload.php
### PUT Edit an existing upload based on upload_id

#### Expected data
E.g
```JSON
{
	"upload_id":"4",
	"file_name": "sample_file4",
	"file":"path/to/sample_file.pdf",
	"contributor":"contributor4",
	"coverage":null,
	"creator": "creator4",
	"date":"12-01-2022",
	"description":"description for the article journal sample_file4",
	"format":"PDF",
	"identifier":"123456",
	"language":"English",
	"publisher":"Random Publishing",
	"relation":null,
	"rights":"All rights Reserved",
	"source":null,
	"title":"Sample File",
	"upload_status":"1",
	"template_name":"Article Journal",
	"subject": ["keyword2","keyword6"]
}
```
#### RETURN
returns a message notify the upload is editted successfully with all data about the upload including keywords related to them through keyword_upload table
E.g

```JSON
{
	"massge":"upload has been editted successfully",
	"data":
	{
		"upload_id":"4",
		"file_name": "sample_file4",
		"contributor":"contributor4",
		"coverage":null,
		"creator": "creator4",
		"date":"12-01-2022",
		"description":"description for the article journal sample_file4",
		"format":"PDF",
		"identifier":"123456",
		"language":"English",
		"publisher":"Random Publishing",
		"relation":null,
		"rights":"All rights Reserved",
		"source":null,
		"title":"Sample File",
		"first_name":"Creator4",
		"last_name":"Creator4",
		"email":"creator4@example.com",
		"upload_status":"2",
		"template_name":"Article Journal",
		"subject": ["keyword2","keyword6", "keyword3", "keyword4"]
	}
}
```



## uploads/searchUpload.php
### GET Display all approved uploads data which is related to the provided keyword.

#### PARAMS provided_keyword

#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.

#### RETURN
returns all data approved uploads which contain keywords or names is related to provided keyword
E.g
```JSON
{
	"uploads": [
		{
			"upload_id": "2",
			"file_name": "sample_file2",
			"contributor":null,
			"coverage":null,
			"creator": null,
			"date":null,
			"description":null,
			"format":"PDF",
			"identifier":"12345",
			"language":"English",
			"publisher":"Random Publishing",
			"relation":null,
			"rights":"All rights Reserved",
			"source":null,
			"title":"Sample File",
			"first_name":"Creator2",
			"last_name":"Creator2",
			"email":"creator2@example.com",
			"upload_status":"1",
			"template_name":"Advertisement Newspaper",
			"subject": ["keyword3","keyword4"]
		},
		{
			"upload_id": "3",
			"file_name": "sample_file3",
			"contributor":"contributor3",
			"coverage":null,
			"creator": null,
			"date":null,
			"description":null,
			"format":"PDF",
			"identifier":"123456",
			"language":"English",
			"publisher":"Random Publishing",
			"relation":null,
			"rights":"All rights Reserved",
			"source":null,
			"title":"Sample File",
			"first_name":"Creator3",
			"last_name":"Creator3",
			"email":"creator3@example.com",
			"upload_status":"1",
			"template_name":"Article Journal",
			"subject": ["keyword3","keyword4"]
		}
	]
}
```


## uploads/approveUpload.php
### PUT receive a user_upload_id and edit the upload_status of the upload to "published" (2 in upload_status table)
#### PARAMS user_upload_id
#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.
#### RETURN
return a message notify that the upload has been approved

## uploads/askMoreInfoUpload.php
### PUT receive a user_upload_id and edit the upload_status of the upload to "archived" (3 in upload_status table) and send an email to ask for more information
#### PARAMS user_upload_id
#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.
#### RETURN
edit the upload_status of the upload to "archived" (3 in upload_status table) and send an email to ask for more information, returns a message to notify the email has been sent


## uploads/filterUpload.php
### GET Display all approved uploads data which is related to the provided keyword and reach the condition of template_name, date range and containing filter_cartype in file_name/title/description or keywords related.

#### PARAMS provided_keyword, filter_date_range_start, filter_date_range_end, filter_template_name, filter_cartype

#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.

#### RETURN
returns all approved uploads data which is related to the provided keyword and reach the condition of template_name, date is in between filter_date_range_start and filter_date_range_end and containing filter_cartype in file_name/title/description or keywords related
E.g
```JSON
{
	"uploads": [
		{
			"upload_id": "2",
			"file_name": "sample_file2",
			"contributor":null,
			"coverage":null,
			"creator": null,
			"date":null,
			"description":null,
			"format":"PDF",
			"identifier":"12345",
			"language":"English",
			"publisher":"Random Publishing",
			"relation":null,
			"rights":"All rights Reserved",
			"source":null,
			"title":"Sample File",
			"first_name":"Creator2",
			"last_name":"Creator2",
			"email":"creator2@example.com",
			"upload_status":"1",
			"template_name":"Advertisement Newspaper",
			"subject": ["keyword3","keyword4"]
		},
		{
			"upload_id": "3",
			"file_name": "sample_file3",
			"contributor":"contributor3",
			"coverage":null,
			"creator": null,
			"date":null,
			"description":null,
			"format":"PDF",
			"identifier":"123456",
			"language":"English",
			"publisher":"Random Publishing",
			"relation":null,
			"rights":"All rights Reserved",
			"source":null,
			"title":"Sample File",
			"first_name":"Creator3",
			"last_name":"Creator3",
			"email":"creator3@example.com",
			"upload_status":"1",
			"template_name":"Article Journal",
			"subject": ["keyword3","keyword4"]
		}
	]
}
```




## keywords/getKeywords.php
### GET Display all keyword data.
#### PARAMS 
#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.
#### RETURN
returns all keyword provided in keyword table as an array

## keywords/createNewKeywords.php
### POST receive a new keyword, add the provided keyword to the keyword table
#### PARAMS new_keyword
#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.
#### RETURN
returns a message notify that the keyword has been added to the keyword list

## keywords/addKeywordToUpload.php
### POST receive a keyword and a user_upload_id, make the keyword related to the provided upload through creating new row in keyword_upload table
#### PARAMS keyword, user_upload_id
#### STATUS CODE
200 - Page Loaded Successfully 
400 - An error occured that preveted the page from loading.
#### RETURN
returns a message notify that the keyword has been added to the upload and display all keywords related to the provided upload, come with a JSON format
E.g
```JSON
{
	"message": "keyword has been added successfully to the upload",
	"keyword":["keyword4", "keyword5", "keyword6"]
}
```

##admins/login.php
POST