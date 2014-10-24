Statts
====

The purpose of having Statts is to have a centralised place where any stakeholder can query about the status of the system. Statts will collect the information about running services, system load, application version, and return the result in JSON format via HTTP.

## How to
Push 
Syntax:

```
curl -XPOST http://dev.statts.co/v0/push -d "mykey=value" -d "mysecret[content]=my super secret message"
```
Example:

```
curl -XPOST http://dev.statts.co/v0/push -d "auth-service[status]=OK" -d "auth-service[version]=456" -d "auth-service[revision]=09d22d8cce0d81c23923845db5a6a377f7f5ebfc"
```

Pull

```
curl -XGET http://dev.statts.co/v0/pull/{key}
```
Example:
```
$ curl -XGET http://dev.statts.co/v0/pull/mysecret

{
  "mysecret": {
    "content": "my super secret message"
  }
}
```
## License
MIT

